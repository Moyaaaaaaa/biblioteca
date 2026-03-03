<?php

class Multa {

    private $db;

    public function __construct(){
        $database = new Database();
        $this->db = $database->conn;
    }

    public function multasUsuario($id_usuario){

        $sql = "
            SELECT 
                m.id_multa,
                l.titulo,
                m.monto_total,
                m.pagada,
                d.fecha_devolucion
            FROM multa m
            INNER JOIN devolucion_multa dm ON m.id_multa = dm.id_multa
            INNER JOIN devolucion d ON dm.id_devolucion = d.id_devolucion
            INNER JOIN prestamo p ON d.id_prestamo = p.id_prestamo
            INNER JOIN ejemplar_prestamo ep ON p.id_prestamo = ep.id_prestamo
            INNER JOIN ejemplar e ON ep.id_ejemplar = e.id_ejemplar
            INNER JOIN libro l ON e.id_libro = l.id_libro
            WHERE p.id_usuario = :id_usuario
            GROUP BY m.id_multa
        ";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            ':id_usuario' => $id_usuario
        ]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}