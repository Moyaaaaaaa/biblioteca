<?php

class Libro
{

    private $db;

    public function __construct()
    {

        $database = new Database();
        $this->db = $database->conn;
    }

    // ==========================
    // CATÁLOGO PARA USUARIO
    // ==========================

    public function catalogoUsuario()
    {

        $sql = "SELECT 
                    l.id_libro,
                    l.titulo,
                    l.isbn,
                    l.anio_publicacion,
                    GROUP_CONCAT(DISTINCT a.nombre ORDER BY a.nombre SEPARATOR ', ') AS autores,
                    COUNT(DISTINCT e.id_ejemplar) AS total_ejemplares,
                    COUNT(DISTINCT CASE 
                    WHEN e.id_estado = 1 THEN e.id_ejemplar
                    END) AS disponibles
                FROM libro l
                LEFT JOIN libro_autor la ON l.id_libro = la.id_libro
                LEFT JOIN autor a ON la.id_autor = a.id_autor
                LEFT JOIN ejemplar e ON l.id_libro = e.id_libro
                GROUP BY l.id_libro";

        $stmt = $this->db->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function obtenerLibro($id_libro)
    {

        $sql = "SELECT titulo
            FROM libro
            WHERE id_libro = :id";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([':id' => $id_libro]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
