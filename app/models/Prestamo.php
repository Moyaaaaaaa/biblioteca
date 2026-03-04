<?php

class Prestamo
{

    private $db;

    public function __construct()
    {
        $database = new Database();
        $this->db = $database->conn;
    }

    public function prestamosUsuario($id_usuario)
    {

        $sql = "
    SELECT 
        p.id_prestamo,
        l.titulo,
        p.fecha_prestamo,
        p.fecha_limite
    FROM prestamo p
    INNER JOIN ejemplar_prestamo ep ON p.id_prestamo = ep.id_prestamo
    INNER JOIN ejemplar e ON ep.id_ejemplar = e.id_ejemplar
    INNER JOIN libro l ON e.id_libro = l.id_libro
    LEFT JOIN devolucion d ON p.id_prestamo = d.id_prestamo
    WHERE p.id_usuario = :id_usuario
    AND d.id_devolucion IS NULL
";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            ':id_usuario' => $id_usuario
        ]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function crearPrestamo($id_usuario, $id_libro)
    {

        try {

            $this->db->beginTransaction();

            // 1️⃣ Buscar ejemplar disponible
            $sql = "SELECT id_ejemplar, id_condicion
        FROM ejemplar
        WHERE id_libro = :id_libro
        AND id_estado = 1
        LIMIT 1";

            $stmt = $this->db->prepare($sql);
            $stmt->execute([':id_libro' => $id_libro]);

            $ejemplar = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$ejemplar) {
                throw new Exception("No hay ejemplares disponibles");
            }

            $id_ejemplar = $ejemplar['id_ejemplar'];
            $condicion_prestamo = $ejemplar['id_condicion'];
            // 2️⃣ Crear préstamo (3 días)
            $fecha_prestamo = date('Y-m-d');
            $fecha_limite = date('Y-m-d', strtotime('+3 days'));

            $sql = "INSERT INTO prestamo (id_usuario, fecha_prestamo, fecha_limite)
                VALUES (:id_usuario, :fecha_prestamo, :fecha_limite)";

            $stmt = $this->db->prepare($sql);
            $stmt->execute([
                ':id_usuario' => $id_usuario,
                ':fecha_prestamo' => $fecha_prestamo,
                ':fecha_limite' => $fecha_limite
            ]);

            $id_prestamo = $this->db->lastInsertId();

            // 3️⃣ Insertar relación ejemplar_prestamo
            $sql = "INSERT INTO ejemplar_prestamo
        (id_prestamo, id_ejemplar, condicion_prestamo)
        VALUES
        (:id_prestamo, :id_ejemplar, :condicion)";

            $stmt = $this->db->prepare($sql);
            $stmt->execute([
                ':id_prestamo' => $id_prestamo,
                ':id_ejemplar' => $id_ejemplar,
                ':condicion' => $condicion_prestamo
            ]);

            // 4️⃣ Cambiar estado del ejemplar a Prestado (2)
            $sql = "UPDATE ejemplar
                SET id_estado = 2
                WHERE id_ejemplar = :id_ejemplar";

            $stmt = $this->db->prepare($sql);
            $stmt->execute([
                ':id_ejemplar' => $id_ejemplar
            ]);

            $this->db->commit();

            return true;
        } catch (Exception $e) {

            $this->db->rollBack();
            return false;
        }
    }
    public function todosPrestamosActivos()
    {

        $sql = "
        SELECT 
            p.id_prestamo,
            u.nombre,
            l.titulo,
            p.fecha_prestamo,
            p.fecha_limite
        FROM prestamo p
        INNER JOIN usuario u ON p.id_usuario = u.id_usuario
        INNER JOIN ejemplar_prestamo ep ON p.id_prestamo = ep.id_prestamo
        INNER JOIN ejemplar e ON ep.id_ejemplar = e.id_ejemplar
        INNER JOIN libro l ON e.id_libro = l.id_libro
        LEFT JOIN devolucion d ON p.id_prestamo = d.id_prestamo
        WHERE d.id_devolucion IS NULL
        ORDER BY p.fecha_prestamo DESC
    ";

        $stmt = $this->db->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function devolver($id_prestamo, $condicion_devuelta)
    {

        $sql = "SELECT 
            ep.id_ejemplar,
            ep.condicion_prestamo,
            p.fecha_limite,
            p.id_usuario,
            l.titulo
        FROM ejemplar_prestamo ep
        JOIN prestamo p ON ep.id_prestamo = p.id_prestamo
        JOIN ejemplar e ON ep.id_ejemplar = e.id_ejemplar
        JOIN libro l ON e.id_libro = l.id_libro
        WHERE p.id_prestamo = :id";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            ':id' => $id_prestamo
        ]);

        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$data) {
            return false;
        }

        $fecha_devolucion = date("Y-m-d");

        $condicion_original = $data['condicion_prestamo'];

        $multa_condicion = false;

        // -------------------------
        // 5️⃣ comparar condición
        // -------------------------

        if ($condicion_devuelta > $condicion_original) {
            $multa_condicion = true;
        }

        // -------------------------
        // 6️⃣ actualizar ejemplar
        // -------------------------

        $sql = "UPDATE ejemplar
            SET id_estado = 1,
                id_condicion = :condicion
            WHERE id_ejemplar = :id";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            ':condicion' => $condicion_devuelta,
            ':id' => $data['id_ejemplar']
        ]);

        // -------------------------
        // registrar devolución
        // -------------------------

        $sql = "INSERT INTO devolucion
            (id_prestamo, fecha_devolucion, id_condicion)
            VALUES
            (:id_prestamo, :fecha_devolucion, :condicion)";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            ':id_prestamo' => $id_prestamo,
            ':fecha_devolucion' => $fecha_devolucion,
            ':condicion' => $condicion_devuelta
        ]);

        // -------------------------
        // calcular retraso
        // -------------------------

        $dias_retraso = floor(
            (strtotime($fecha_devolucion) - strtotime($data['fecha_limite'])) / 86400
        );

        $monto = 0;
        $multa = false;

        // -------------------------
        // 7️⃣ multa por retraso
        // -------------------------

        if ($dias_retraso > 0) {

            $monto += $dias_retraso * 10;
            $multa = true;
        }

        // -------------------------
        // multa por condición
        // -------------------------

        if ($multa_condicion) {

            $monto += 50;
            $multa = true;
        }

        // -------------------------
        // registrar multa
        // -------------------------

        if ($multa) {

            $sql = "INSERT INTO multa
        (monto_total, pagada)
        VALUES
        (:monto, 0)";

            $stmt = $this->db->prepare($sql);
            $stmt->execute([
                ':monto' => $monto
            ]);
        }

        return [
            'multa' => $multa,
            'monto' => $monto,
            'titulo' => $data['titulo'],
            'id_usuario' => $data['id_usuario']
        ];
    }
    public function devolucionesUsuario($id_usuario)
    {

        $sql = "
        SELECT 
            l.titulo,
            d.fecha_devolucion,
            p.fecha_limite,

            CASE 
                WHEN d.fecha_devolucion > p.fecha_limite 
                THEN DATEDIFF(d.fecha_devolucion, p.fecha_limite)
                ELSE 0
            END AS dias_retraso

        FROM devolucion d

        INNER JOIN prestamo p 
        ON d.id_prestamo = p.id_prestamo

        INNER JOIN ejemplar_prestamo ep 
        ON p.id_prestamo = ep.id_prestamo

        INNER JOIN ejemplar e 
        ON ep.id_ejemplar = e.id_ejemplar

        INNER JOIN libro l 
        ON e.id_libro = l.id_libro

        WHERE p.id_usuario = :id_usuario

        ORDER BY d.fecha_devolucion DESC
    ";

        $stmt = $this->db->prepare($sql);

        $stmt->execute([
            ':id_usuario' => $id_usuario
        ]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
