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

        if (isset($_SESSION['usuario'])) {

            if ($_SESSION['usuario']['id_rol'] == 1) {

                header("Location: " . BASE_URL . "AdminController/index");
            } elseif ($_SESSION['usuario']['id_rol'] == 5) {

                header("Location: " . BASE_URL . "BibliotecarioController/index");
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

        // Validar campos
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

        // Si login es correcto
        if ($usuario) {

            $_SESSION['usuario'] = $usuario;

            // 🔹 ADMINISTRADOR
            if ($usuario['id_rol'] == 1) {

                header("Location: " . BASE_URL . "AdminController/index");

                // 🔹 BIBLIOTECARIO
            } elseif ($usuario['id_rol'] == 5) {

                header("Location: " . BASE_URL . "BibliotecarioController/index");

                // 🔹 TODOS LOS DEMÁS ROLES
            } else {

                header("Location: " . BASE_URL . "DashboardController/index");
            }

            $bitacora = $this->model('Bitacora');

            $bitacora->registrar(
                1,
                "Inicio de sesión del usuario ".$_SESSION['usuario']['username']
            );

            exit;
        }

        $this->view('auth/error_login');
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

    public function recuperar()
    {
        $this->view('auth/recuperar');
    }

    public function generarRecuperacion()
    {

        $usuario = $_POST['usuario'];
        $correo = $_POST['correo'];

        $usuarioModel = $this->model('Usuario');

        $user = $usuarioModel->buscarPorUsuarioCorreo($usuario, $correo);

        if (!$user) {

            $this->view('auth/error_recuperacion');

            return;

        }

        $recModel = $this->model('Recuperacion');

        $token = $recModel->generarToken($user['id_usuario']);

        $link = BASE_URL . "AuthController/reset?token=" . $token;

        $this->view('auth/enlace_generado', [
            'link' => $link
        ]);
    }

    public function reset()
    {

        $token = $_GET['token'];

        $recModel = $this->model('Recuperacion');

        $rec = $recModel->validarToken($token);

        if (!$rec) {

            echo "Token inválido o expirado";
            return;
        }

        $this->view('auth/reset', [
            'token' => $token
        ]);
    }

    public function guardarNuevaPassword()
    {

        $token = $_POST['token'];
        $password = $_POST['password'];

        $recModel = $this->model('Recuperacion');

        $rec = $recModel->validarToken($token);

        if (!$rec) {

            echo "Token inválido";
            return;
        }

        $usuarioModel = $this->model('Usuario');

        $usuarioModel->actualizarPassword(
            $rec['id_usuario'],
            $password
        );

        $recModel->marcarUsado($rec['id_recuperacion']);

        header("Location: " . BASE_URL . "AuthController/login");
    }
}
