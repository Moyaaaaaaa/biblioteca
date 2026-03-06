<?php

class BibliotecarioEditorialController extends Controller
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

        if ($_SESSION['usuario']['id_rol'] != 5 && $_SESSION['usuario']['id_rol'] != 1) {
            echo "Acceso denegado";
            exit;
        }
    }

    public function index()
    {

        $editorialModel = $this->model('Editorial');

        $editoriales = $editorialModel->todas();

        $this->view('bibliotecario/editoriales/index', [
            'editoriales' => $editoriales
        ]);
    }

    public function crear()
    {

        $this->view('bibliotecario/editoriales/crear');
    }

    public function guardar()
    {

        $editorialModel = $this->model('Editorial');

        $editorialModel->crear($_POST['editorial']);

        header("Location: " . BASE_URL . "BibliotecarioEditorialController/index");
        exit;
    }

    public function editar($id)
    {

        $editorialModel = $this->model('Editorial');

        $editorial = $editorialModel->obtener($id);

        $this->view('bibliotecario/editoriales/editar', [
            'editorial' => $editorial
        ]);
    }

    public function actualizar()
    {

        $editorialModel = $this->model('Editorial');

        $editorialModel->actualizar(
            $_POST['id_editorial'],
            $_POST['editorial']
        );

        header("Location: " . BASE_URL . "BibliotecarioEditorialController/index");
        exit;
    }

    public function eliminar($id)
    {

        $editorialModel = $this->model('Editorial');

        $editorialModel->eliminar($id);

        header("Location: " . BASE_URL . "BibliotecarioEditorialController/index");
        exit;
    }
}
