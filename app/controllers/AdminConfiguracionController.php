<?php

class AdminConfiguracionController extends Controller
{

    public function __construct()
    {

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['id_rol'] != 1) {
            header("Location: " . BASE_URL . "AuthController/login");
            exit;
        }
    }

    public function index()
    {

        $configModel = $this->model('Configuracion');

        $config = $configModel->obtener();

        $this->view('admin/configuracion', [
            'config' => $config
        ]);
    }

    public function actualizar()
    {

        $configModel = $this->model('Configuracion');

        $configModel->actualizar(
            $_POST['dias_prestamo'],
            $_POST['multa_dia']
        );

        header("Location: " . BASE_URL . "AdminConfiguracionController/index");
        exit;
    }
}
