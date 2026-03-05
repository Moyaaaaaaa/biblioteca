<?php

class Editorial
{

private $db;

public function __construct()
{

$database = new Database();
$this->db = $database->conn;

}

public function todas()
{

$sql = "SELECT * FROM editorial ORDER BY editorial";

$stmt = $this->db->prepare($sql);
$stmt->execute();

return $stmt->fetchAll(PDO::FETCH_ASSOC);

}

public function obtener($id)
{

$sql = "SELECT * FROM editorial
WHERE id_editorial=:id";

$stmt = $this->db->prepare($sql);

$stmt->execute([
':id'=>$id
]);

return $stmt->fetch(PDO::FETCH_ASSOC);

}

public function crear($editorial)
{

$sql = "INSERT INTO editorial
(editorial)
VALUES
(:editorial)";

$stmt = $this->db->prepare($sql);

$stmt->execute([
':editorial'=>$editorial
]);

}

public function actualizar($id,$editorial)
{

$sql = "UPDATE editorial
SET editorial=:editorial
WHERE id_editorial=:id";

$stmt = $this->db->prepare($sql);

$stmt->execute([
':editorial'=>$editorial,
':id'=>$id
]);

}

public function eliminar($id)
{

$sql = "DELETE FROM editorial
WHERE id_editorial=:id";

$stmt = $this->db->prepare($sql);

$stmt->execute([
':id'=>$id
]);

}

}