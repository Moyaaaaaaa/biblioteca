<?php

class Notificacion {

    private $db;

    public function __construct(){
        $database = new Database();
        $this->db = $database->conn;
    }

    public function crear($id_usuario, $mensaje){

        $fecha = date("Y-m-d");
        $hora  = date("H:i:s");

        $sql = "INSERT INTO notificacion
                (id_usuario, mensaje, fecha_notificacion, hora_notificacion)
                VALUES
                (:id_usuario, :mensaje, :fecha, :hora)";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            ':id_usuario' => $id_usuario,
            ':mensaje' => $mensaje,
            ':fecha' => $fecha,
            ':hora' => $hora
        ]);
    }

    public function obtenerPorUsuario($id_usuario){

        $sql = "SELECT * FROM notificacion
                WHERE id_usuario = :id
                ORDER BY id_notificacion DESC";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([':id'=>$id_usuario]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}