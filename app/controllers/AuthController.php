<?php

class AuthController extends Controller
{

    // ============================
    // MOSTRAR LOGIN
    // ============================

    public function login()
    {

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // si ya inició sesión
        if (isset($_SESSION['usuario'])) {

            // si es administrador
            if ($_SESSION['usuario']['id_rol'] == 1) {

                header("Location: " . BASE_URL . "AdminController/index");

            } else {

                header("Location: " . BASE_URL . "DashboardController/index");

            }

            exit;
        }

        $this->view('auth/login');

    }



    // ============================
    // AUTENTICAR LOGIN
    // ============================

    public function autenticar()
    {

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // validar POST
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


        // LOGIN CORRECTO
        if ($usuario) {

            $_SESSION['usuario'] = $usuario;

            // ADMINISTRADOR
            if ($usuario['id_rol'] == 1) {

                header("Location: " . BASE_URL . "AdminController/index");

            } else {

                header("Location: " . BASE_URL . "DashboardController/index");

            }

            exit;

        }

        echo "Credenciales incorrectas";

    }



    // ============================
    // CERRAR SESIÓN
    // ============================

    public function logout()
    {

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        session_destroy();

        header("Location: " . BASE_URL . "AuthController/login");

        exit;

    }



    // ============================
    // FORMULARIO REGISTRO
    // ============================

    public function registro()
    {

        $rolModel = $this->model('Rol');

        $roles = $rolModel->obtenerRoles();

        $this->view('auth/registro', $roles);

    }



    // ============================
    // GUARDAR USUARIO
    // ============================

    public function guardarUsuario()
    {

        // validar campos básicos
        if (

            empty($_POST['nombre']) ||
            empty($_POST['apellido_paterno']) ||
            empty($_POST['username']) ||
            empty($_POST['correo']) ||
            empty($_POST['contrasenia']) ||
            empty($_POST['fecha_nacimiento']) ||
            empty($_POST['id_rol'])

        ) {

            echo "Campos incompletos";
            return;

        }

        $usuarioModel = $this->model('Usuario');

        $usuarioModel->crearUsuario(

            $_POST['nombre'],
            $_POST['apellido_paterno'],
            $_POST['apellido_materno'] ?? null,
            $_POST['username'],
            $_POST['correo'],
            $_POST['contrasenia'],
            $_POST['fecha_nacimiento'],
            $_POST['id_rol']

        );

        header("Location: " . BASE_URL . "AuthController/login");

        exit;

    }

}