<?php

class Database {

    private $host = "localhost";
    private $db   = "biblioteca";
    private $user = "root";
    private $pass = "";
    private $charset = "utf8mb4";

    public $conn;

    public function __construct(){

        $dsn = "mysql:host=".$this->host.";dbname=".$this->db.";charset=".$this->charset;

        try{

            $this->conn = new PDO(

                $dsn,
                $this->user,
                $this->pass

            );

            $this->conn->setAttribute(

                PDO::ATTR_ERRMODE,
                PDO::ERRMODE_EXCEPTION

            );

        }catch(PDOException $e){

            die("Error conexión: ".$e->getMessage());

        }

    }

}