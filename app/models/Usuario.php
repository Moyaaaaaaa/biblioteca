<?php

class Usuario
{

    private $db;

    public function __construct()
    {

        $database = new Database();

        $this->db = $database->conn;

    }


    public function login($username, $contrasenia)
    {

        $sql = "SELECT * FROM usuario
            WHERE username = :username
            LIMIT 1";

        $stmt = $this->db->prepare($sql);

        $stmt->execute([

            ':username' => $username

        ]);

        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);


        // comparación directa
        if ($usuario && $usuario['contrasenia'] === $contrasenia) {

            return $usuario;

        }

        return false;

    }

    public function crearUsuario(

        $nombre,
        $apellidoPaterno,
        $apellidoMaterno,
        $username,
        $correo,
        $contrasenia,
        $fechaNacimiento,
        $idRol

    ) {

        $sql = "INSERT INTO usuario(

nombre,
apellido_paterno,
apellido_materno,
username,
correo,
contrasenia,
fecha_nacimiento,
id_rol

)

VALUES(

:nombre,
:apellido_paterno,
:apellido_materno,
:username,
:correo,
:contrasenia,
:fecha_nacimiento,
:id_rol

)";


        $stmt = $this->db->prepare($sql);

        $stmt->execute([

            ':nombre' => $nombre,
            ':apellido_paterno' => $apellidoPaterno,
            ':apellido_materno' => $apellidoMaterno,
            ':username' => $username,
            ':correo' => $correo,
            ':contrasenia' => $contrasenia,
            ':fecha_nacimiento' => $fechaNacimiento,
            ':id_rol' => $idRol

        ]);

    }

}