<?php

class BibliotecarioLibroController extends Controller
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

        $libroModel = $this->model('Libro');

        $libros = $libroModel->todos();

        $this->view('bibliotecario/libros/index', [
            'libros' => $libros
        ]);
    }

    public function crear()
    {

        $categoriaModel = $this->model('Categoria');
        $autorModel = $this->model('Autor');
        $editorialModel = $this->model('Editorial');

        $categorias = $categoriaModel->todas();
        $autores = $autorModel->todos();
        $editoriales = $editorialModel->todas();

        $this->view('bibliotecario/libros/crear', [
            'categorias' => $categorias,
            'autores' => $autores,
            'editoriales' => $editoriales
        ]);
    }

    public function guardar()
    {

        $libroModel = $this->model('Libro');

        $libroModel->crear(
            $_POST['titulo'],
            $_POST['isbn'],
            $_POST['anio_publicacion'],
            $_POST['id_categoria'],
            $_POST['id_editorial'],
            $_POST['autores']
        );

        header("Location: " . BASE_URL . "BibliotecarioLibroController/index");
        exit;
    }

    public function editar($id)
    {

        $libroModel = $this->model('Libro');
        $categoriaModel = $this->model('Categoria');
        $autorModel = $this->model('Autor');
        $editorialModel = $this->model('Editorial');

        $libro = $libroModel->obtenerPorId($id);

        $categorias = $categoriaModel->todas();
        $autores = $autorModel->todos();
        $editoriales = $editorialModel->todas();

        $autoresLibro = $libroModel->autoresLibro($id);

        $this->view('bibliotecario/libros/editar', [
            'libro' => $libro,
            'categorias' => $categorias,
            'autores' => $autores,
            'editoriales' => $editoriales,
            'autoresLibro' => $autoresLibro
        ]);
    }

    public function actualizar()
    {

        $libroModel = $this->model('Libro');

        $libroModel->actualizar(
            $_POST['id_libro'],
            $_POST['titulo'],
            $_POST['isbn'],
            $_POST['anio_publicacion'],
            $_POST['id_categoria'],
            $_POST['id_editorial']
        );

        $libroModel->actualizarAutores(
            $_POST['id_libro'],
            $_POST['autores']
        );

        header("Location: " . BASE_URL . "BibliotecarioLibroController/index");
        exit;
    }

    public function eliminar($id)
    {

        $libroModel = $this->model('Libro');

        $resultado = $libroModel->eliminar($id);

        if (!$resultado) {

            $this->view('bibliotecario/error_eliminar_libro');
            return;
        }

        header("Location: " . BASE_URL . "BibliotecarioLibroController/index");
        exit;
    }
}
