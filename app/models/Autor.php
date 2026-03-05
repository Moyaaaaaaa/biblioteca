<?php

class Autor
{

    private $db;

    public function __construct()
    {
        $database = new Database();
        $this->db = $database->conn;
    }

    public function listarAutores()
    {

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
    public function todos(){

$sql = "SELECT 
id_autor,
nombre,
apellido_paterno,
apellido_materno,
nacionalidad
FROM autor
ORDER BY nombre";

$stmt = $this->db->prepare($sql);

$stmt->execute();

return $stmt->fetchAll(PDO::FETCH_ASSOC);

}

    public function obtener($id)
    {

        $sql = "SELECT * FROM autor
WHERE id_autor=:id";

        $stmt = $this->db->prepare($sql);

        $stmt->execute([
            ':id' => $id
        ]);

        return $stmt->fetch(PDO::FETCH_ASSOC);

    }
}