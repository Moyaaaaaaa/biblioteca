<?php

class Usuario
{

    private $db;

    public function __construct()
    {

        $database = new Database();
        $this->db = $database->conn;

    }

    // ======================
    // LOGIN
    // ======================

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

        if ($usuario && $usuario['contrasenia'] === $contrasenia) {
            return $usuario;
        }

        return false;

    }


    // ======================
    // CREAR USUARIO
    // ======================

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


    // ======================
    // LISTAR USUARIOS
    // ======================

    public function todos()
    {

        $sql = "SELECT 
u.id_usuario,
u.nombre,
u.apellido_paterno,
u.apellido_materno,
u.username,
u.correo,
r.nombre_rol

FROM usuario u

LEFT JOIN rol r
ON u.id_rol = r.id_rol

ORDER BY u.nombre, u.apellido_paterno";

        $stmt = $this->db->prepare($sql);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);

    }


    // ======================
    // OBTENER USUARIO
    // ======================

    public function obtenerPorId($id)
    {

        $sql = "SELECT * FROM usuario
                WHERE id_usuario = :id";

        $stmt = $this->db->prepare($sql);

        $stmt->execute([
            ':id' => $id
        ]);

        return $stmt->fetch(PDO::FETCH_ASSOC);

    }


    // ======================
    // ACTUALIZAR USUARIO
    // ======================

    public function actualizar($id, $nombre, $ap, $am, $username, $correo, $rol)
    {

        $sql = "UPDATE usuario
                SET nombre=:nombre,
                apellido_paterno=:ap,
                apellido_materno=:am,
                username=:username,
                correo=:correo,
                id_rol=:rol
                WHERE id_usuario=:id";

        $stmt = $this->db->prepare($sql);

        $stmt->execute([
            ':nombre' => $nombre,
            ':ap' => $ap,
            ':am' => $am,
            ':username' => $username,
            ':correo' => $correo,
            ':rol' => $rol,
            ':id' => $id
        ]);

    }


    // ======================
    // ELIMINAR USUARIO
    // ======================

    public function eliminar($id)
    {

        $sql = "DELETE FROM usuario
                WHERE id_usuario=:id";

        $stmt = $this->db->prepare($sql);

        $stmt->execute([
            ':id' => $id
        ]);

    }

    public function buscarPorUsuarioCorreo($usuario, $correo)
    {

        $sql = "SELECT *
            FROM usuario
            WHERE username = :usuario
            AND correo = :correo";

        $stmt = $this->db->prepare($sql);

        $stmt->execute([
            ':usuario' => $usuario,
            ':correo' => $correo
        ]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function actualizarPassword($id_usuario, $password)
    {

        $sql = "UPDATE usuario
            SET contrasenia = :password
            WHERE id_usuario = :id";

        $stmt = $this->db->prepare($sql);

        $stmt->execute([
            ':password' => $password,
            ':id' => $id_usuario
        ]);

    }

    public function obtenerUsername($id_usuario)
    {

        $sql = "SELECT username
            FROM usuario
            WHERE id_usuario = :id";

        $stmt = $this->db->prepare($sql);

        $stmt->execute([
            ':id' => $id_usuario
        ]);

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        return $user['username'];
    }

}