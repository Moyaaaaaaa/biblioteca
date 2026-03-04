<?php

class Ejemplar {

    private $db;

    public function __construct(){
        $database = new Database();
        $this->db = $database->conn;
    }

    public function todos(){

        $sql = "SELECT
                e.id_ejemplar,
                l.titulo,
                e.codigo_etiqueta,
                es.estado,
                c.condicion
                FROM ejemplar e
                JOIN libro l
                ON e.id_libro = l.id_libro
                JOIN estado es
                ON e.id_estado = es.id_estado
                JOIN condicion c
                ON e.id_condicion = c.id_condicion";

        $stmt = $this->db->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function crear($libro,$codigo,$estado,$condicion){

        $sql = "INSERT INTO ejemplar
                (id_libro,codigo_etiqueta,id_estado,id_condicion)
                VALUES
                (:libro,:codigo,:estado,:condicion)";

        $stmt = $this->db->prepare($sql);

        $stmt->execute([
            ':libro'=>$libro,
            ':codigo'=>$codigo,
            ':estado'=>$estado,
            ':condicion'=>$condicion
        ]);
    }

    public function obtenerPorId($id){

        $sql = "SELECT * FROM ejemplar
                WHERE id_ejemplar=:id";

        $stmt = $this->db->prepare($sql);

        $stmt->execute([
            ':id'=>$id
        ]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function actualizar($id,$libro,$codigo,$estado,$condicion){

        $sql = "UPDATE ejemplar
                SET id_libro=:libro,
                    codigo_etiqueta=:codigo,
                    id_estado=:estado,
                    id_condicion=:condicion
                WHERE id_ejemplar=:id";

        $stmt = $this->db->prepare($sql);

        $stmt->execute([
            ':libro'=>$libro,
            ':codigo'=>$codigo,
            ':estado'=>$estado,
            ':condicion'=>$condicion,
            ':id'=>$id
        ]);
    }

    public function eliminar($id){

        $sql = "DELETE FROM ejemplar
                WHERE id_ejemplar=:id";

        $stmt = $this->db->prepare($sql);

        $stmt->execute([
            ':id'=>$id
        ]);
    }

}