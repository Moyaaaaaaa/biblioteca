<?php

class PrestamoController extends Controller
{

    public function __construct()
    {

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['usuario'])) {
            header("Location: " . BASE_URL . "AuthController/login");
            exit;
        }
    }


    public function misPrestamos()
    {

        $prestamoModel = $this->model('Prestamo');

        $prestamos = $prestamoModel->prestamosUsuario(
            $_SESSION['usuario']['id_usuario']
        );

        $this->view('usuario/prestamos', [
            'prestamos' => $prestamos
        ]);
    }



    public function crear()
    {

        if (!isset($_POST['id_libro'])) {
            header("Location: " . BASE_URL . "LibroController/catalogo");
            exit;
        }

        $id_libro = $_POST['id_libro'];
        $id_usuario = $_SESSION['usuario']['id_usuario'];
        $rol = $_SESSION['usuario']['id_rol'];

        $prestamoModel = $this->model('Prestamo');


        $prestamos_activos = $prestamoModel->prestamosActivosUsuario($id_usuario);

        $limite = 0;

        switch ($rol) {

            case 2: 
                $limite = 3;
                break;

            case 3: 
                $limite = 5;
                break;

            case 4: 
                $limite = 2;
                break;

            default:
                $limite = 3;
        }

        if ($prestamos_activos >= $limite) {

            $this->view('usuarios/limite_prestamos', [
                'limite' => $limite
            ]);

            return;
        }


        $libroModel = $this->model('Libro');
        $libro = $libroModel->obtenerLibro($id_libro);

        if (!$libro) {

            echo "El libro no existe.";
            exit;
        }

        $titulo = $libro['titulo'];


        $configModel = $this->model('Configuracion');

        $config = $configModel->obtenerPorRol($rol);

        if (!$config) {

            echo "No existe configuración para este tipo de usuario.";
            exit;
        }

        $dias = $config['dias_prestamo'];


        $fecha_limite = date('Y-m-d', strtotime("+$dias days"));



        $resultado = $prestamoModel->crearPrestamo($id_usuario, $id_libro, $rol);

        if ($resultado === "multa_pendiente") {

            echo "No puedes solicitar préstamos hasta pagar tus multas.";
            exit;
        }

        $bitacora = $this->model('Bitacora');

        $bitacora->registrar(
            2,
            "Préstamo del libro " . $titulo . " al usuario " . $_SESSION['usuario']['username']
        );

        if ($resultado) {

            $notificacion = $this->model('Notificacion');

            $mensaje = "Has solicitado el libro '" . $titulo .
                "' con fecha límite " . $fecha_limite;

            $notificacion->crear($id_usuario, $mensaje);
        }

        header("Location: " . BASE_URL . "PrestamoController/misPrestamos");
        exit;
    }
}