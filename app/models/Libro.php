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
        c.categoria,
        GROUP_CONCAT(DISTINCT a.nombre ORDER BY a.nombre SEPARATOR ', ') AS autores,
        COUNT(DISTINCT e.id_ejemplar) AS total_ejemplares,
        COUNT(DISTINCT CASE 
            WHEN e.id_estado = 1 THEN e.id_ejemplar
        END) AS disponibles

        FROM libro l

        LEFT JOIN categoria c
        ON l.id_categoria = c.id_categoria

        LEFT JOIN libro_autor la 
        ON l.id_libro = la.id_libro

        LEFT JOIN autor a 
        ON la.id_autor = a.id_autor

        LEFT JOIN ejemplar e 
        ON l.id_libro = e.id_libro

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

    public function crear($titulo, $isbn, $anio, $categoria)
    {

        $sql = "INSERT INTO libro
                (titulo,isbn,anio_publicacion,id_categoria)
                VALUES
                (:titulo,:isbn,:anio,:categoria)";

        $stmt = $this->db->prepare($sql);

        $stmt->execute([
            ':titulo' => $titulo,
            ':isbn' => $isbn,
            ':anio' => $anio,
            ':categoria' => $categoria
        ]);
    }

    public function obtenerPorId($id)
    {

        $sql = "SELECT * FROM libro
                WHERE id_libro=:id";

        $stmt = $this->db->prepare($sql);

        $stmt->execute([
            ':id' => $id
        ]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function actualizar($id, $titulo, $isbn, $anio, $categoria)
    {

        $sql = "UPDATE libro
                SET titulo=:titulo,
                    isbn=:isbn,
                    anio_publicacion=:anio,
                    id_categoria=:categoria
                WHERE id_libro=:id";

        $stmt = $this->db->prepare($sql);

        $stmt->execute([
            ':titulo' => $titulo,
            ':isbn' => $isbn,
            ':anio' => $anio,
            ':categoria' => $categoria,
            ':id' => $id
        ]);
    }

    public function eliminar($id)
    {

        $sql = "DELETE FROM libro
                WHERE id_libro=:id";

        $stmt = $this->db->prepare($sql);

        $stmt->execute([
            ':id' => $id
        ]);
    }

    public function autoresLibro($id_libro)
    {

        $sql = "SELECT id_autor
                FROM libro_autor
                WHERE id_libro=:id";

        $stmt = $this->db->prepare($sql);

        $stmt->execute([
            ':id' => $id_libro
        ]);

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $ids = [];

        foreach ($result as $r) {
            $ids[] = $r['id_autor'];
        }

        return $ids;
    }
}
