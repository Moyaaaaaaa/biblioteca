<?php

class AutorController extends Controller
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

        $autorModel = $this->model('Autor');
        $autores = $autorModel->listarAutores();

        $this->view('usuario/autores', [
            'autores' => $autores
        ]);
    }

    public function libros($id_autor)
    {

        $libroModel = $this->model('Libro');
        $autorModel = $this->model('Autor');

        $autor = $autorModel->obtener($id_autor);

        $libros = $libroModel->librosPorAutor($id_autor);

        $this->view('usuario/libros_autor', [
            'autor' => $autor,
            'libros' => $libros
        ]);

    }
}