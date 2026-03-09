<?php
require_once '../app/models/Configuracion.php';

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
            e.codigo_etiqueta,
            c.condicion,
            p.fecha_prestamo,
            p.fecha_limite
        FROM prestamo p
        INNER JOIN ejemplar e ON p.id_ejemplar = e.id_ejemplar
        INNER JOIN libro l ON e.id_libro = l.id_libro
        INNER JOIN condicion c ON e.id_condicion = c.id_condicion
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


    public function crearPrestamo($id_usuario, $id_libro, $id_rol)
    {

        $sql = "SELECT COUNT(*) as total
        FROM multa m
        JOIN devolucion_multa dm ON m.id_multa = dm.id_multa
        JOIN devolucion d ON dm.id_devolucion = d.id_devolucion
        JOIN prestamo p ON d.id_prestamo = p.id_prestamo
        WHERE p.id_usuario = :usuario
        AND m.pagada = 0";

        $stmt = $this->db->prepare($sql);

        $stmt->execute([
            ':usuario' => $id_usuario
        ]);

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result['total'] > 0) {
            return "multa_pendiente";
        }

        try {

            $this->db->beginTransaction();

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

            $fecha_prestamo = date('Y-m-d');

            $configModel = new Configuracion();
            $config = $configModel->obtenerPorRol($id_rol);

            $fecha_limite = date('Y-m-d', strtotime("+" . $config['dias_prestamo'] . " days"));

            $sql = "INSERT INTO prestamo 
                    (id_usuario, id_ejemplar, fecha_prestamo, fecha_limite)
                    VALUES 
                    (:id_usuario, :id_ejemplar, :fecha_prestamo, :fecha_limite)";

            $stmt = $this->db->prepare($sql);
            $stmt->execute([
                ':id_usuario' => $id_usuario,
                ':id_ejemplar' => $id_ejemplar,
                ':fecha_prestamo' => $fecha_prestamo,
                ':fecha_limite' => $fecha_limite
            ]);

            $sql = "UPDATE ejemplar
                    SET id_estado = 2
                    WHERE id_ejemplar = :id_ejemplar";

            $stmt = $this->db->prepare($sql);
            $stmt->execute([
                ':id_ejemplar' => $id_ejemplar
            ]);

            $this->db->commit();

            return [
                'titulo' => $this->obtenerTituloLibro($id_libro),
                'fecha_limite' => $fecha_limite
            ];

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
        e.codigo_etiqueta,
        p.fecha_prestamo,
        p.fecha_limite,
        e.id_condicion,
        c.condicion
        FROM prestamo p
        INNER JOIN usuario u ON p.id_usuario = u.id_usuario
        INNER JOIN ejemplar e ON p.id_ejemplar = e.id_ejemplar
        INNER JOIN libro l ON e.id_libro = l.id_libro
        INNER JOIN condicion c ON e.id_condicion = c.id_condicion
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

    try {

        $this->db->beginTransaction();

        $sql = "SELECT 
                p.id_ejemplar,
                e.id_condicion,
                p.fecha_limite,
                p.id_usuario,
                l.titulo
            FROM prestamo p
            JOIN ejemplar e ON p.id_ejemplar = e.id_ejemplar
            JOIN libro l ON e.id_libro = l.id_libro
            WHERE p.id_prestamo = :id";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([':id' => $id_prestamo]);

        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$data) {
            throw new Exception("Prestamo no encontrado");
        }

        $fecha_devolucion = date("Y-m-d");

        $dias_retraso = (strtotime($fecha_devolucion) - strtotime($data['fecha_limite'])) / 86400;

        if ($dias_retraso < 0) {
            $dias_retraso = 0;
        }

        /* REGISTRAR DEVOLUCION */

        $sql = "INSERT INTO devolucion
            (id_prestamo, fecha_devolucion, dias_retraso, id_condicion)
            VALUES
            (:prestamo, :fecha, :retraso, :condicion)";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            ':prestamo' => $id_prestamo,
            ':fecha' => $fecha_devolucion,
            ':retraso' => $dias_retraso,
            ':condicion' => $condicion_devuelta
        ]);

        $id_devolucion = $this->db->lastInsertId();

        /* ACTUALIZAR ESTADO DEL EJEMPLAR */

        $sql = "UPDATE ejemplar
            SET id_estado = 1,
                id_condicion = :condicion
            WHERE id_ejemplar = :ejemplar";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            ':condicion' => $condicion_devuelta,
            ':ejemplar' => $data['id_ejemplar']
        ]);

        $multa = false;
        $monto_total = 0;
        $motivos = [];

        /* MULTA POR RETRASO */

        if ($dias_retraso > 0) {

            $configModel = new Configuracion();
            $config = $configModel->obtenerPorRol(
                $this->obtenerRolUsuario($data['id_usuario'])
            );

            $multa = true;

            $monto_total += $dias_retraso * $config['multa_dia'];

            $motivos[] = 1;
        }

        /* MULTA POR DAÑO */

        if ($condicion_devuelta > $data['id_condicion']) {

            if ($condicion_devuelta == 2) {
                $id_catalogo = 2;
            } else {
                $id_catalogo = 3;
            }

            $sql = "SELECT monto 
                    FROM catalogo_multa 
                    WHERE id_catalogo_multa = :id";

            $stmt = $this->db->prepare($sql);
            $stmt->execute([':id' => $id_catalogo]);

            $cat = $stmt->fetch(PDO::FETCH_ASSOC);

            $multa = true;

            $monto_total += $cat['monto'];

            $motivos[] = $id_catalogo;
        }

        /* CREAR MULTA */

        if ($multa) {

            $sql = "INSERT INTO multa
                (monto_total, pagada)
                VALUES
                (:monto, 0)";

            $stmt = $this->db->prepare($sql);
            $stmt->execute([
                ':monto' => $monto_total
            ]);

            $id_multa = $this->db->lastInsertId();

            $sql = "INSERT INTO devolucion_multa
                (id_devolucion, id_multa)
                VALUES
                (:devolucion, :multa)";

            $stmt = $this->db->prepare($sql);
            $stmt->execute([
                ':devolucion' => $id_devolucion,
                ':multa' => $id_multa
            ]);

            foreach ($motivos as $motivo) {

                $sql = "INSERT INTO multa_catalogo_multa
                    (id_multa, id_catalogo_multa)
                    VALUES
                    (:multa, :catalogo)";

                $stmt = $this->db->prepare($sql);
                $stmt->execute([
                    ':multa' => $id_multa,
                    ':catalogo' => $motivo
                ]);
            }
        }

        $this->db->commit();

        return [
            'multa' => $multa,
            'monto' => $monto_total,
            'titulo' => $data['titulo'],
            'id_usuario' => $data['id_usuario']
        ];

    } catch (Exception $e) {

        $this->db->rollBack();
        return false;
    }
}


    private function obtenerTituloLibro($id_libro)
    {

        $sql = "SELECT titulo FROM libro WHERE id_libro = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':id' => $id_libro]);

        $libro = $stmt->fetch(PDO::FETCH_ASSOC);

        return $libro ? $libro['titulo'] : '';
    }


    private function obtenerRolUsuario($id_usuario)
    {
        $sql = "SELECT id_rol FROM usuario WHERE id_usuario = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':id' => $id_usuario]);

        $res = $stmt->fetch(PDO::FETCH_ASSOC);

        return $res['id_rol'];
    }


    public function prestamosActivosUsuario($id_usuario)
    {

        $sql = "SELECT COUNT(*) as total
        FROM prestamo p
        LEFT JOIN devolucion d ON p.id_prestamo = d.id_prestamo 
        WHERE p.id_usuario = :usuario
        AND d.id_devolucion IS NULL";

        $stmt = $this->db->prepare($sql);

        $stmt->execute([
            ':usuario' => $id_usuario
        ]);

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result['total'];
    }

    public function detallePrestamo($id_prestamo)
    {

        $sql = "SELECT
            p.id_prestamo,
            p.id_usuario,
            l.titulo,
            e.codigo_etiqueta,
            c.condicion,
            p.fecha_limite
            FROM prestamo p
            JOIN ejemplar e ON p.id_ejemplar = e.id_ejemplar
            JOIN libro l ON e.id_libro = l.id_libro
            JOIN condicion c ON e.id_condicion = c.id_condicion
            WHERE p.id_prestamo = :id";

        $stmt = $this->db->prepare($sql);

        $stmt->execute([
            ':id' => $id_prestamo
        ]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}