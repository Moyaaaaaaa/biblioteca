<?php

class BibliotecarioEjemplarController extends Controller
{

    public function __construct()
    {

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['id_rol'] != 5) {
            header("Location: " . BASE_URL . "AuthController/login");
            exit;
        }

    }

    public function index()
    {

        $ejemplarModel = $this->model('Ejemplar');

        $ejemplares = $ejemplarModel->todos();

        $this->view('bibliotecario/ejemplares/index', [
            'ejemplares' => $ejemplares
        ]);

    }

    public function crear($id_libro = null)
    {

        $libroModel = $this->model('Libro');
        $condicionModel = $this->model('Condicion');
        $ubicacionModel = $this->model('Ubicacion');

        $condiciones = $condicionModel->todas();
        $ubicaciones = $ubicacionModel->todas();

        if ($id_libro) {

            $libro = $libroModel->obtenerPorId($id_libro);

        } else {

            $libros = $libroModel->todos();

        }

        $this->view('bibliotecario/ejemplares/crear', [
            'libro' => $id_libro ? $libro : null,
            'libros' => $id_libro ? null : $libros,
            'id_libro' => $id_libro,
            'condiciones' => $condiciones,
            'ubicaciones' => $ubicaciones
        ]);

    }

    public function guardar()
    {

        $ejemplarModel = $this->model('Ejemplar');

        $ejemplarModel->crear(
            $_POST['id_libro'],
            $_POST['edicion'],
            $_POST['anio_edicion'],
            $_POST['id_ubicacion'],
            $_POST['id_condicion']
        );

        header("Location: " . BASE_URL . "BibliotecarioEjemplarController/index");
        exit;

    }

    public function editar($id)
    {

        $ejemplarModel = $this->model('Ejemplar');
        $libroModel = $this->model('Libro');
        $condicionModel = $this->model('Condicion');
        $estadoModel = $this->model('Estado');
        $ubicacionModel = $this->model('Ubicacion');

        $ejemplar = $ejemplarModel->obtenerPorId($id);

        $libros = $libroModel->todos();
        $condiciones = $condicionModel->todas();
        $estados = $estadoModel->todos();
        $ubicaciones = $ubicacionModel->todas();

        $this->view('bibliotecario/ejemplares/editar', [
            'ejemplar' => $ejemplar,
            'libros' => $libros,
            'condiciones' => $condiciones,
            'estados' => $estados,
            'ubicaciones' => $ubicaciones
        ]);

    }

    public function actualizar()
    {

        $ejemplarModel = $this->model('Ejemplar');

        $ejemplarModel->actualizar(
            $_POST['id_ejemplar'],
            $_POST['id_libro'],
            $_POST['codigo_etiqueta'],
            $_POST['id_estado'],
            $_POST['id_condicion'],
            $_POST['id_ubicacion'],
            $_POST['edicion'],
            $_POST['anio_edicion']
        );

        header("Location: " . BASE_URL . "BibliotecarioEjemplarController/index");
        exit;

    }

    public function eliminar($id)
    {

        $ejemplarModel = $this->model('Ejemplar');

        $ejemplarModel->eliminar($id);

        header("Location: " . BASE_URL . "BibliotecarioEjemplarController/index");
        exit;

    }

}