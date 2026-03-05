<?php

class Ejemplar
{

    private $db;

    public function __construct()
    {
        $database = new Database();
        $this->db = $database->conn;
    }

    public function todos()
    {

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

    public function crear($id_libro, $edicion, $anio, $ubicacion, $condicion)
    {

        $sql = "SELECT titulo FROM libro WHERE id_libro = :id";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([':id' => $id_libro]);

        $libro = $stmt->fetch(PDO::FETCH_ASSOC);

        $titulo = $libro['titulo'];

        $palabras = explode(" ", $titulo);

        $iniciales = "";

        foreach ($palabras as $p) {

            $p = trim($p);

            if (strlen($p) > 2) {
                $iniciales .= strtoupper(substr($p, 0, 1));
            }

        }

        if (strlen($iniciales) < 3) {
            $iniciales = strtoupper(substr($titulo, 0, 3));
        }

        $sql = "SELECT COUNT(*) total
FROM ejemplar
WHERE id_libro = :libro";

        $stmt = $this->db->prepare($sql);

        $stmt->execute([
            ':libro' => $id_libro
        ]);

        $count = $stmt->fetch(PDO::FETCH_ASSOC)['total'] + 1;

        $numero = str_pad($count, 3, "0", STR_PAD_LEFT);

        $codigo = $iniciales . "-" . $numero;

        $sql = "INSERT INTO ejemplar
(id_libro,codigo_etiqueta,edicion,anio_edicion,id_ubicacion,id_estado,id_condicion)
VALUES
(:libro,:codigo,:edicion,:anio,:ubicacion,1,:condicion)";

        $stmt = $this->db->prepare($sql);

        $stmt->execute([
            ':libro' => $id_libro,
            ':codigo' => $codigo,
            ':edicion' => $edicion,
            ':anio' => $anio,
            ':ubicacion' => $ubicacion,
            ':condicion' => $condicion
        ]);

    }

    public function obtenerPorId($id)
    {

        $sql = "SELECT * FROM ejemplar
                WHERE id_ejemplar=:id";

        $stmt = $this->db->prepare($sql);

        $stmt->execute([
            ':id' => $id
        ]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function actualizar($id, $libro, $codigo, $estado, $condicion)
    {

        $sql = "UPDATE ejemplar
                SET id_libro=:libro,
                    codigo_etiqueta=:codigo,
                    id_estado=:estado,
                    id_condicion=:condicion
                WHERE id_ejemplar=:id";

        $stmt = $this->db->prepare($sql);

        $stmt->execute([
            ':libro' => $libro,
            ':codigo' => $codigo,
            ':estado' => $estado,
            ':condicion' => $condicion,
            ':id' => $id
        ]);
    }

    public function eliminar($id)
    {

        $sql = "DELETE FROM ejemplar
                WHERE id_ejemplar=:id";

        $stmt = $this->db->prepare($sql);

        $stmt->execute([
            ':id' => $id
        ]);
    }

}