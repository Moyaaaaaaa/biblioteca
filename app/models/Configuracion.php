<?php

class Configuracion
{

    private $db;

    public function __construct()
    {
        $database = new Database();
        $this->db = $database->conn;
    }

    public function obtener()
    {

        $sql = "SELECT * FROM configuracion_sistema LIMIT 1";

        $stmt = $this->db->prepare($sql);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function actualizar($dias, $multa)
    {

        $sql = "UPDATE configuracion_sistema
SET dias_prestamo=:dias,
multa_dia=:multa
WHERE id_config=1";

        $stmt = $this->db->prepare($sql);

        $stmt->execute([
            ':dias' => $dias,
            ':multa' => $multa
        ]);
    }
}
