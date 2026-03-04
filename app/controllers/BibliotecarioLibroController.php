<?php

class BibliotecarioLibroController extends Controller {

    public function __construct(){

        if(session_status() === PHP_SESSION_NONE){
            session_start();
        }

        if(!isset($_SESSION['usuario']) || $_SESSION['usuario']['id_rol'] != 3){
            header("Location: ".BASE_URL."AuthController/login");
            exit;
        }

    }

    public function index(){

        $libroModel = $this->model('Libro');

        $libros = $libroModel->todos();

        $this->view('bibliotecario/libros/index',[
            'libros'=>$libros
        ]);

    }

    public function crear(){

        $categoriaModel = $this->model('Categoria');
        $autorModel = $this->model('Autor');

        $categorias = $categoriaModel->todas();
        $autores = $autorModel->todos();

        $this->view('bibliotecario/libros/crear',[
            'categorias'=>$categorias,
            'autores'=>$autores
        ]);

    }

    public function guardar(){

        $libroModel = $this->model('Libro');

        $libroModel->crear(
            $_POST['titulo'],
            $_POST['isbn'],
            $_POST['anio_publicacion'],
            $_POST['id_categoria']
        );

        header("Location: ".BASE_URL."BibliotecarioLibroController/index");
        exit;

    }

    public function editar($id){

        $libroModel = $this->model('Libro');
        $categoriaModel = $this->model('Categoria');

        $libro = $libroModel->obtenerPorId($id);
        $categorias = $categoriaModel->todas();

        $this->view('bibliotecario/libros/editar',[
            'libro'=>$libro,
            'categorias'=>$categorias
        ]);

    }

    public function actualizar(){

        $libroModel = $this->model('Libro');

        $libroModel->actualizar(
            $_POST['id_libro'],
            $_POST['titulo'],
            $_POST['isbn'],
            $_POST['anio_publicacion'],
            $_POST['id_categoria']
        );

        header("Location: ".BASE_URL."BibliotecarioLibroController/index");
        exit;

    }

    public function eliminar($id){

        $libroModel = $this->model('Libro');

        $libroModel->eliminar($id);

        header("Location: ".BASE_URL."BibliotecarioLibroController/index");
        exit;

    }

}