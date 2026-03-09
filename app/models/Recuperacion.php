<?php

class Recuperacion
{

    private $db;

    public function __construct()
    {
        $database = new Database();
        $this->db = $database->conn;
    }

    public function generarToken($id_usuario)
    {

        $token = bin2hex(random_bytes(32));

        $expira = date("Y-m-d H:i:s", strtotime("+30 minutes"));

        $sql = "INSERT INTO recuperacion_password
                (id_usuario, token, expira)
                VALUES
                (:usuario, :token, :expira)";

        $stmt = $this->db->prepare($sql);

        $stmt->execute([
            ':usuario' => $id_usuario,
            ':token' => $token,
            ':expira' => $expira
        ]);

        return $token;
    }

    public function validarToken($token)
    {

        $sql = "SELECT *
                FROM recuperacion_password
                WHERE token = :token
                AND usado = 0
                AND expira > NOW()";

        $stmt = $this->db->prepare($sql);

        $stmt->execute([
            ':token' => $token
        ]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function marcarUsado($id)
    {

        $sql = "UPDATE recuperacion_password
                SET usado = 1
                WHERE id_recuperacion = :id";

        $stmt = $this->db->prepare($sql);

        $stmt->execute([
            ':id' => $id
        ]);
    }
}