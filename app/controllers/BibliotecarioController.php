<?php

class BibliotecarioController extends Controller
{

    public function __construct()
    {

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Debe estar logueado
        if (!isset($_SESSION['usuario'])) {
            header("Location: " . BASE_URL . "AuthController/login");
            exit;
        }

        // SOLO BIBLIOTECARIO (id_rol = 5)
        if ($_SESSION['usuario']['id_rol'] != 5 && $_SESSION['usuario']['id_rol'] != 1) {
            echo "Acceso denegado";
            exit;
        }
    }

    public function index()
    {
        $this->view('bibliotecario/index');
    }

    public function prestamosActivos()
    {

        $prestamoModel = $this->model('Prestamo');
        $prestamos = $prestamoModel->todosPrestamosActivos();

        $this->view('bibliotecario/prestamos', [
            'prestamos' => $prestamos
        ]);
    }
    public function devolver($id_prestamo)
    {

        $prestamoModel = $this->model('Prestamo');

        $prestamo = $prestamoModel->detallePrestamo($id_prestamo);

        $condicionModel = $this->model('Condicion');
        $condiciones = $condicionModel->todas();

        $this->view('bibliotecario/devolver', [
            'prestamo' => $prestamo,
            'condiciones' => $condiciones
        ]);

        $bitacora = $this->model('Bitacora');

        $bitacora->registrar(
            3,
            "Visualización de devolución del libro " . $prestamo['titulo']
        );
    }
}
