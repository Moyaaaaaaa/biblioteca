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
            $sql = "SELECT id_ejemplar
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
            $sql = "INSERT INTO ejemplar_prestamo (id_prestamo, id_ejemplar)
                VALUES (:id_prestamo, :id_ejemplar)";

            $stmt = $this->db->prepare($sql);
            $stmt->execute([
                ':id_prestamo' => $id_prestamo,
                ':id_ejemplar' => $id_ejemplar
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
}
