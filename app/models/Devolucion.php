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
}