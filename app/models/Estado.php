<?php

class Estado {

private $db;

public function __construct(){

$database = new Database();
$this->db = $database->conn;

}

public function todos(){

$sql = "SELECT id_estado, estado
FROM estado
ORDER BY id_estado";

$stmt = $this->db->prepare($sql);
$stmt->execute();

return $stmt->fetchAll(PDO::FETCH_ASSOC);

}

}