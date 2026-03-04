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

        // obtener modelo libro
        $libroModel = $this->model('Libro');
        $libro = $libroModel->obtenerLibro($id_libro);

        $titulo = $libro['titulo'];

        // calcular fecha limite
        $fecha_limite = date('Y-m-d', strtotime('+3 days'));

        // crear préstamo
        $prestamoModel = $this->model('Prestamo');
        $resultado = $prestamoModel->crearPrestamo($id_usuario, $id_libro);

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
