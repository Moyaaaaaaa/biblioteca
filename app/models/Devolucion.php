<?php

class Devolucion {

    private $db;

    public function __construct(){
        $database = new Database();
        $this->db = $database->conn;
    }

    public function devolucionesUsuario($id_usuario){

        $sql = "
            SELECT 
                d.id_devolucion,
                l.titulo,
                p.fecha_prestamo,
                d.fecha_devolucion,
                d.dias_retraso
            FROM devolucion d
            INNER JOIN prestamo p ON d.id_prestamo = p.id_prestamo
            INNER JOIN ejemplar_prestamo ep ON p.id_prestamo = ep.id_prestamo
            INNER JOIN ejemplar e ON ep.id_ejemplar = e.id_ejemplar
            INNER JOIN libro l ON e.id_libro = l.id_libro
            WHERE p.id_usuario = :id_usuario
            GROUP BY d.id_devolucion
        ";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            ':id_usuario' => $id_usuario
        ]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function procesarDevolucion($id_prestamo){

    try{

        $this->db->beginTransaction();

        // 1️⃣ Obtener préstamo
        $sql = "SELECT fecha_limite
                FROM prestamo
                WHERE id_prestamo = :id_prestamo";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([':id_prestamo'=>$id_prestamo]);

        $prestamo = $stmt->fetch(PDO::FETCH_ASSOC);

        if(!$prestamo){
            throw new Exception("Préstamo no encontrado");
        }

        $fecha_limite = new DateTime($prestamo['fecha_limite']);
        $fecha_actual = new DateTime();

        $dias_retraso = $fecha_actual > $fecha_limite
            ? $fecha_limite->diff($fecha_actual)->days
            : 0;

        // 2️⃣ Insertar devolución
        $sql = "INSERT INTO devolucion
                (id_prestamo, fecha_devolucion, dias_retraso, id_condicion)
                VALUES
                (:id_prestamo, :fecha_devolucion, :dias_retraso, 1)";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            ':id_prestamo'=>$id_prestamo,
            ':fecha_devolucion'=>$fecha_actual->format('Y-m-d'),
            ':dias_retraso'=>$dias_retraso
        ]);

        $id_devolucion = $this->db->lastInsertId();

        // 3️⃣ Cambiar estado del ejemplar a Disponible
        $sql = "UPDATE ejemplar
                SET id_estado = 1
                WHERE id_ejemplar = (
                    SELECT id_ejemplar
                    FROM ejemplar_prestamo
                    WHERE id_prestamo = :id_prestamo
                    LIMIT 1
                )";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([':id_prestamo'=>$id_prestamo]);

        // 4️⃣ Si hay retraso, generar multa
        if($dias_retraso > 0){

            $monto_por_dia = 10; // puedes cambiarlo
            $monto_total = $dias_retraso * $monto_por_dia;

            // Insertar multa
            $sql = "INSERT INTO multa (monto_total, pagada)
                    VALUES (:monto_total, 0)";

            $stmt = $this->db->prepare($sql);
            $stmt->execute([
                ':monto_total'=>$monto_total
            ]);

            $id_multa = $this->db->lastInsertId();

            // Relacionar multa con devolución
            $sql = "INSERT INTO devolucion_multa
                    (id_devolucion, id_multa)
                    VALUES (:id_devolucion, :id_multa)";

            $stmt = $this->db->prepare($sql);
            $stmt->execute([
                ':id_devolucion'=>$id_devolucion,
                ':id_multa'=>$id_multa
            ]);
        }

        $this->db->commit();

    }catch(Exception $e){

        $this->db->rollBack();
    }
}
}