<?php

class Libro
{

    private $db;

    public function __construct()
    {
        $database = new Database();
        $this->db = $database->conn;
    }

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

    public function todos()
    {

        $sql = "SELECT 
l.id_libro,
l.titulo,
l.isbn,
l.anio_publicacion,
c.categoria,

GROUP_CONCAT(
DISTINCT CONCAT(a.nombre,' ',a.apellido_paterno,' ',a.apellido_materno)
SEPARATOR ', '
) AS autores,

COUNT(DISTINCT e.id_ejemplar) AS ejemplares

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

    public function crear($titulo, $isbn, $anio, $categoria, $editorial, $autores)
    {

        $this->db->beginTransaction();

        $sql = "INSERT INTO libro
(titulo,isbn,anio_publicacion,id_categoria,id_editorial)
VALUES
(:titulo,:isbn,:anio,:categoria,:editorial)";

        $stmt = $this->db->prepare($sql);

        $stmt->execute([
            ':titulo' => $titulo,
            ':isbn' => $isbn,
            ':anio' => $anio,
            ':categoria' => $categoria,
            ':editorial' => $editorial
        ]);

        $id_libro = $this->db->lastInsertId();

        foreach ($autores as $autor) {

            $sql = "INSERT INTO libro_autor
(id_libro,id_autor)
VALUES
(:libro,:autor)";

            $stmt = $this->db->prepare($sql);

            $stmt->execute([
                ':libro' => $id_libro,
                ':autor' => $autor
            ]);
        }

        $this->db->commit();
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

    public function actualizar($id, $titulo, $isbn, $anio, $categoria, $editorial)
    {

        $sql = "UPDATE libro
SET titulo=:titulo,
isbn=:isbn,
anio_publicacion=:anio,
id_categoria=:categoria,
id_editorial=:editorial
WHERE id_libro=:id";

        $stmt = $this->db->prepare($sql);

        $stmt->execute([
            ':titulo' => $titulo,
            ':isbn' => $isbn,
            ':anio' => $anio,
            ':categoria' => $categoria,
            ':editorial' => $editorial,
            ':id' => $id
        ]);
    }

    public function eliminar($id_libro)
    {

        try {

            $this->db->beginTransaction();


            $sql = "DELETE FROM libro_autor
                WHERE id_libro = :id";

            $stmt = $this->db->prepare($sql);
            $stmt->execute([
                ':id' => $id_libro
            ]);


            $sql = "DELETE FROM libro
                WHERE id_libro = :id";

            $stmt = $this->db->prepare($sql);
            $stmt->execute([
                ':id' => $id_libro
            ]);

            $this->db->commit();

            return true;

        } catch (Exception $e) {

            $this->db->rollBack();

            return false;
        }
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

    public function actualizarAutores($id_libro, $autores)
    {

        $sql = "DELETE FROM libro_autor
WHERE id_libro=:id";

        $stmt = $this->db->prepare($sql);

        $stmt->execute([
            ':id' => $id_libro
        ]);

        foreach ($autores as $autor) {

            $sql = "INSERT INTO libro_autor
(id_libro,id_autor)
VALUES
(:libro,:autor)";

            $stmt = $this->db->prepare($sql);

            $stmt->execute([
                ':libro' => $id_libro,
                ':autor' => $autor
            ]);
        }
    }

    public function librosPorAutor($id_autor)
    {

        $sql = "SELECT 
l.id_libro,
l.titulo,
l.isbn,
l.anio_publicacion,
c.categoria,
COUNT(DISTINCT e.id_ejemplar) AS total_ejemplares,
COUNT(DISTINCT CASE 
WHEN e.id_estado = 1 THEN e.id_ejemplar
END) AS disponibles

FROM libro l

JOIN libro_autor la
ON l.id_libro = la.id_libro

LEFT JOIN categoria c
ON l.id_categoria = c.id_categoria

LEFT JOIN ejemplar e
ON l.id_libro = e.id_libro

WHERE la.id_autor = :autor

GROUP BY l.id_libro";

        $stmt = $this->db->prepare($sql);

        $stmt->execute([
            ':autor' => $id_autor
        ]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}