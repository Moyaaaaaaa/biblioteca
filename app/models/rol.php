<?php

class Rol {

    private $db;

    public function __construct(){

        $database = new Database();

        $this->db = $database->conn;

    }


    public function obtenerRoles(){

        $sql = "SELECT id_rol, nombre_rol FROM rol";

        $stmt = $this->db->prepare($sql);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);

    }

}