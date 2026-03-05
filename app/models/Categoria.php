<?php

class Categoria
{

    private $db;

    public function __construct()
    {
        $database = new Database();
        $this->db = $database->conn;
    }

    public function todas()
    {

        $sql = "SELECT 
                id_categoria,
                categoria
                FROM categoria
                ORDER BY categoria";

        $stmt = $this->db->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function obtenerPorId($id)
    {

        $sql = "SELECT *
                FROM categoria
                WHERE id_categoria = :id";

        $stmt = $this->db->prepare($sql);

        $stmt->execute([
            ':id' => $id
        ]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function crear($categoria)
    {

        $sql = "INSERT INTO categoria
                (categoria)
                VALUES
                (:categoria)";

        $stmt = $this->db->prepare($sql);

        $stmt->execute([
            ':categoria' => $categoria
        ]);
    }

    public function actualizar($id, $categoria)
    {

        $sql = "UPDATE categoria
                SET categoria = :categoria
                WHERE id_categoria = :id";

        $stmt = $this->db->prepare($sql);

        $stmt->execute([
            ':categoria' => $categoria,
            ':id' => $id
        ]);
    }

    public function eliminar($id)
    {

        $sql = "DELETE FROM categoria
                WHERE id_categoria = :id";

        $stmt = $this->db->prepare($sql);

        $stmt->execute([
            ':id' => $id
        ]);
    }

    public function librosPorCategoria($id_categoria)
    {

        $sql = "SELECT 
                l.id_libro,
                l.titulo,
                c.categoria,
                COUNT(e.id_ejemplar) AS total,
                SUM(CASE WHEN e.id_estado = 1 THEN 1 ELSE 0 END) AS disponibles
                FROM libro l
                LEFT JOIN categoria c 
                ON l.id_categoria = c.id_categoria
                LEFT JOIN ejemplar e 
                ON l.id_libro = e.id_libro
                WHERE l.id_categoria = :categoria
                GROUP BY l.id_libro";

        $stmt = $this->db->prepare($sql);

        $stmt->execute([
            ':categoria' => $id_categoria
        ]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

}