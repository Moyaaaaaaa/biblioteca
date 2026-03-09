<?php

class AdminConfiguracionController extends Controller
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

        $configModel = $this->model('Configuracion');

        $configs = $configModel->obtenerConfiguraciones();

        $this->view('admin/configuracion', [
            'configuraciones' => $configs
        ]);
    }

    public function actualizar()
    {

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $configModel = $this->model('Configuracion');

            foreach ($_POST['dias_prestamo'] as $id_config => $dias) {

                $multa = $_POST['multa_dia'][$id_config];

                $configModel->actualizar($id_config, $dias, $multa);
            }
            $bitacora = $this->model('Bitacora');

            $bitacora->registrar(
                4,
                "Configuración del sistema modificada"
            );

            header("Location: " . BASE_URL . "AdminConfiguracionController/index");
            exit;
        }
    }
}