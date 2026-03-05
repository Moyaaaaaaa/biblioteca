<?php

class Editorial {

private $db;

public function __construct(){

$database = new Database();
$this->db = $database->conn;

}

public function todas(){

$sql = "SELECT * FROM editorial";

$stmt = $this->db->prepare($sql);

$stmt->execute();

return $stmt->fetchAll(PDO::FETCH_ASSOC);

}

}