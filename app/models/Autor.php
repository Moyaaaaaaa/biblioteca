<?php

class Autor {

    private $db;

    public function __construct(){
        $database = new Database();
        $this->db = $database->conn;
    }

    public function listarAutores(){

        $sql = "
            SELECT 
                a.id_autor,
                a.nombre,
                a.apellido_paterno,
                a.apellido_materno,
                a.nacionalidad,
                COUNT(la.id_libro) AS total_libros
            FROM autor a
            LEFT JOIN libro_autor la ON a.id_autor = la.id_autor
            GROUP BY a.id_autor
        ";

        $stmt = $this->db->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}