<?php

class AuthController extends Controller
{

    // Mostrar formulario login
    public function login()
    {

        // si ya inició sesión lo mandamos al dashboard
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (isset($_SESSION['usuario'])) {

            header("Location: " . BASE_URL . "DashboardController/index");
            exit;

        }

        $this->view('auth/login');

    }


    // Procesar login
    public function autenticar()
    {

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // validar que existan datos POST
        if (

            empty($_POST['username']) ||
            empty($_POST['contrasenia'])

        ) {

            echo "Campos vacíos";
            return;

        }

        $usuarioModel = $this->model('Usuario');

        $usuario = $usuarioModel->login(

            $_POST['username'],
            $_POST['contrasenia']

        );

        // si login correcto
        if ($usuario) {

            $_SESSION['usuario'] = $usuario;

            header("Location: " . BASE_URL . "DashboardController/index");
            exit;

        }

        echo "Credenciales incorrectas";

    }


    // cerrar sesión
    public function logout()
    {

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        session_destroy();

        header("Location: " . BASE_URL . "AuthController/login");
        exit;

    }

    // mostrar formulario registro
    public function registro(){

    $rolModel = $this->model('Rol');

    $roles = $rolModel->obtenerRoles();

    $this->view('auth/registro', $roles);

}

    public function guardarUsuario(){

    $usuarioModel=$this->model('Usuario');

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

    header("Location: ".BASE_URL."AuthController/login");

    exit;

}

}