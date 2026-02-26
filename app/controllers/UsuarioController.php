<?php

class UsuarioController extends Controller {


    // ===========================
    // SEGURIDAD ADMINISTRADOR
    // ===========================

    public function __construct(){

        if(session_status() === PHP_SESSION_NONE){
            session_start();
        }

        // login obligatorio
        if(!isset($_SESSION['usuario'])){

            header("Location: ".BASE_URL."AuthController/login");
            exit;

        }

        // SOLO ADMIN
        if($_SESSION['usuario']['id_rol'] != 1){

            echo "Acceso denegado";
            exit;

        }

    }



    // ===========================
    // LISTAR USUARIOS
    // ===========================

    public function index(){

        $usuarioModel = $this->model('Usuario');

        $usuarios = $usuarioModel->obtenerUsuarios();

        $this->view('usuario/index',[
            'usuarios'=>$usuarios
        ]);

    }



    // ===========================
    // FORM CREAR
    // ===========================

    public function create(){

        $usuarioModel = $this->model('Usuario');

        $roles = $usuarioModel->obtenerRoles();

        $this->view('usuario/create',[
            'roles'=>$roles
        ]);

    }



    // ===========================
    // EDITAR FORM
    // ===========================

    public function editar($id){

        $usuarioModel = $this->model('Usuario');

        $usuario = $usuarioModel->obtenerUsuarioPorId($id);

        $roles = $usuarioModel->obtenerRoles();

        $this->view('usuario/editar',[

            'usuario'=>$usuario,
            'roles'=>$roles

        ]);

    }



    // ===========================
    // ACTUALIZAR
    // ===========================

    public function actualizar(){

        $usuarioModel = $this->model('Usuario');

        $usuarioModel->actualizarUsuario(

            $_POST['id_usuario'],
            $_POST['nombre'],
            $_POST['apellido_paterno'],
            $_POST['apellido_materno'],
            $_POST['correo'],
            $_POST['id_rol']

        );

        header("Location: ".BASE_URL."UsuarioController/index");

        exit;

    }



    // ===========================
    // ELIMINAR
    // ===========================

    public function eliminar($id){

        // evitar borrar al admin principal
        if($id == 1){

            echo "No puedes eliminar el administrador principal";

            exit;

        }

        $usuarioModel = $this->model('Usuario');

        $usuarioModel->eliminarUsuario($id);

        header("Location: ".BASE_URL."UsuarioController/index");

        exit;

    }

}