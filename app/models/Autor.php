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
        LEFT JOIN libro_autor la 
        ON a.id_autor = la.id_autor
        GROUP BY a.id_autor
        ORDER BY a.nombre
        ";

        $stmt = $this->db->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function todos()
    {

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

        $sql = "SELECT *
                FROM autor
                WHERE id_autor = :id";

        $stmt = $this->db->prepare($sql);

        $stmt->execute([
            ':id' => $id
        ]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function crear($nombre,$ap,$am,$nacionalidad)
    {

        $sql = "INSERT INTO autor
                (nombre,apellido_paterno,apellido_materno,nacionalidad)
                VALUES
                (:nombre,:ap,:am,:nacionalidad)";

        $stmt = $this->db->prepare($sql);

        $stmt->execute([
            ':nombre' => $nombre,
            ':ap' => $ap,
            ':am' => $am,
            ':nacionalidad' => $nacionalidad
        ]);
    }

    public function actualizar($id,$nombre,$ap,$am,$nacionalidad)
    {

        $sql = "UPDATE autor
                SET nombre = :nombre,
                    apellido_paterno = :ap,
                    apellido_materno = :am,
                    nacionalidad = :nacionalidad
                WHERE id_autor = :id";

        $stmt = $this->db->prepare($sql);

        $stmt->execute([
            ':nombre' => $nombre,
            ':ap' => $ap,
            ':am' => $am,
            ':nacionalidad' => $nacionalidad,
            ':id' => $id
        ]);
    }

    public function eliminar($id)
    {

        $sql = "DELETE FROM autor
                WHERE id_autor = :id";

        $stmt = $this->db->prepare($sql);

        $stmt->execute([
            ':id' => $id
        ]);
    }

    public function librosAutor($id_autor)
    {

        $sql = "
        SELECT 
        l.id_libro,
        l.titulo,
        l.anio_publicacion
        FROM libro l
        INNER JOIN libro_autor la
        ON l.id_libro = la.id_libro
        WHERE la.id_autor = :id
        ";

        $stmt = $this->db->prepare($sql);

        $stmt->execute([
            ':id' => $id_autor
        ]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

}