<?php

class Bitacora
{

    private $db;

    public function __construct()
    {
        $database = new Database();
        $this->db = $database->conn;
    }

    public function registrar($id_accion, $descripcion)
    {

        $sql = "INSERT INTO bitacora
        (fecha_bitacora, hora, id_accion, descripcion_detallada)
        VALUES
        (:fecha, :hora, :accion, :descripcion)";

        $stmt = $this->db->prepare($sql);

        $stmt->execute([
            ':fecha' => date("Y-m-d"),
            ':hora' => date("H:i:s"),
            ':accion' => $id_accion,
            ':descripcion' => $descripcion
        ]);
    }

    public function obtenerTodo()
    {

        $sql = "SELECT 
            b.fecha_bitacora,
            b.hora,
            a.descripcion AS accion,
            b.descripcion_detallada
            FROM bitacora b
            LEFT JOIN accion a
            ON b.id_accion = a.id_accion
            ORDER BY b.fecha_bitacora DESC, b.hora DESC";

        $stmt = $this->db->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}