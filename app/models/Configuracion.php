<?php

class Configuracion
{

    private $db;

    public function __construct()
    {
        $database = new Database();
        $this->db = $database->conn;
    }

    public function obtenerConfiguraciones()
    {

        $sql = "SELECT 
                c.id_config,
                c.id_rol,
                r.nombre_rol,
                c.dias_prestamo,
                c.multa_dia
                FROM configuracion_sistema c
                JOIN rol r ON c.id_rol = r.id_rol";

        $stmt = $this->db->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function obtenerPorRol($id_rol)
    {

        $sql = "SELECT * 
                FROM configuracion_sistema
                WHERE id_rol = :id_rol";

        $stmt = $this->db->prepare($sql);

        $stmt->execute([
            ':id_rol' => $id_rol
        ]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function actualizar($id_config, $dias, $multa)
    {

        $sql = "UPDATE configuracion_sistema
                SET dias_prestamo = :dias,
                    multa_dia = :multa
                WHERE id_config = :id_config";

        $stmt = $this->db->prepare($sql);

        $stmt->execute([
            ':dias' => $dias,
            ':multa' => $multa,
            ':id_config' => $id_config
        ]);
    }
}