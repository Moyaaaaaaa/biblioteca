<?php

class UsuarioController extends Controller
{

    public function __construct()
    {

        if(session_status() === PHP_SESSION_NONE){
            session_start();
        }

        if(!isset($_SESSION['usuario'])){
            header("Location: ".BASE_URL."AuthController/login");
            exit;
        }

        if($_SESSION['usuario']['id_rol'] != 1 && $_SESSION['usuario']['id_rol'] != 5){
            echo "Acceso denegado";
            exit;
        }

    }


    public function index()
    {

        $usuarioModel = $this->model('Usuario');

        $usuarios = $usuarioModel->todos();

        $this->view('usuarios/index',[
            'usuarios'=>$usuarios
        ]);

    }


    public function crear()
    {

        $rolModel = $this->model('Rol');

        $roles = $rolModel->obtenerRoles();

        $this->view('usuarios/crear',[
            'roles'=>$roles
        ]);

    }


    public function guardar()
    {

        $usuarioModel = $this->model('Usuario');

        $usuarioModel->crearUsuario(

            $_POST['nombre'],
            $_POST['apellido_paterno'],
            $_POST['apellido_materno'],
            $_POST['username'],
            $_POST['correo'],
            $_POST['contrasenia'],
            $_POST['fecha_nacimiento'],
            $_POST['id_rol']

        );

        header("Location: ".BASE_URL."UsuarioController/index");

    }


    public function editar($id)
    {

        $usuarioModel = $this->model('Usuario');
        $rolModel = $this->model('Rol');

        $usuario = $usuarioModel->obtenerPorId($id);
        $roles = $rolModel->obtenerRoles();

        $this->view('usuarios/editar',[
            'usuario'=>$usuario,
            'roles'=>$roles
        ]);

    }


    public function actualizar()
    {

        $usuarioModel = $this->model('Usuario');

        $usuarioModel->actualizar(

            $_POST['id_usuario'],
            $_POST['nombre'],
            $_POST['apellido_paterno'],
            $_POST['apellido_materno'],
            $_POST['username'],
            $_POST['correo'],
            $_POST['id_rol']

        );

        header("Location: ".BASE_URL."UsuarioController/index");

    }


    public function eliminar($id)
    {


        if($_SESSION['usuario']['id_rol'] != 1){
            echo "Solo administrador puede eliminar usuarios";
            exit;
        }

        $usuarioModel = $this->model('Usuario');

        $usuarioModel->eliminar($id);

        header("Location: ".BASE_URL."UsuarioController/index");

    }

}