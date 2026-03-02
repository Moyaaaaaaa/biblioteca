<?php

class Libro {

    private $db;

    public function __construct(){
        $database = new Database();
        $this->db = $database->conn;
    }

    public function catalogoUsuario(){

        $sql = "
            SELECT 
                l.id_libro,
                l.titulo,
                l.isbn,
                l.anio_publicacion,
                GROUP_CONCAT(CONCAT(a.nombre,' ',a.apellido_paterno) SEPARATOR ', ') AS autores,
                COUNT(e.id_ejemplar) AS total_ejemplares,
                SUM(CASE WHEN e.id_estado = 1 THEN 1 ELSE 0 END) AS disponibles
            FROM libro l
            LEFT JOIN libro_autor la ON l.id_libro = la.id_libro
            LEFT JOIN autor a ON la.id_autor = a.id_autor
            LEFT JOIN ejemplar e ON l.id_libro = e.id_libro
            GROUP BY l.id_libro
        ";

        $stmt = $this->db->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}