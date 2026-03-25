<?php

class DevolucionController extends Controller
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

    public function index()
    {
        header("Location: " . BASE_URL . "BibliotecarioController/prestamosActivos");
        exit;
    }

    public function devolver()
    {

        if (!isset($_POST['id_prestamo'])) {
            header("Location: " . BASE_URL . "BibliotecarioController/prestamosActivos");
            exit;
        }

        $id_prestamo = $_POST['id_prestamo'];
        $condicion_devuelta = $_POST['condicion_devuelta'];

        $prestamoModel = $this->model('Prestamo');

        $resultado = $prestamoModel->devolver($id_prestamo, $condicion_devuelta);

        if ($resultado) {

            $notificacion = $this->model('Notificacion');

            if (!$resultado['multa']) {

                $mensaje = "El libro '" . $resultado['titulo'] . "' fue devuelto correctamente.";

            } else {

                $mensaje = "Se generó una multa de $" . $resultado['monto'] . " por daño o retraso del libro '" . $resultado['titulo'] . "'.";
            }

            $notificacion->crear($resultado['id_usuario'], $mensaje);
        }

        header("Location: " . BASE_URL . "BibliotecarioController/prestamosActivos");
    }
    public function misDevoluciones()
    {

        $prestamoModel = $this->model('Prestamo');

        $devoluciones = $prestamoModel->devolucionesUsuario(
            $_SESSION['usuario']['id_usuario']
        );

        $this->view('usuario/devoluciones', [
            'devoluciones' => $devoluciones
        ]);
    }


}
