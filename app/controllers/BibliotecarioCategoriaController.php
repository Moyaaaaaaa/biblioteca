<?php

class BibliotecarioCategoriaController extends Controller {

    public function __construct(){

        if(session_status() === PHP_SESSION_NONE){
            session_start();
        }

        if(!isset($_SESSION['usuario']) || $_SESSION['usuario']['id_rol'] != 5){
            header("Location: ".BASE_URL."AuthController/login");
            exit;
        }

    }

    public function index(){

        $categoriaModel = $this->model('Categoria');

        $categorias = $categoriaModel->todas();

        $this->view('bibliotecario/categorias/index',[
            'categorias'=>$categorias
        ]);

    }

    public function crear(){

        $this->view('bibliotecario/categorias/crear');

    }

    public function guardar(){

        $categoriaModel = $this->model('Categoria');

        $categoriaModel->crear($_POST['categoria']);

        header("Location: ".BASE_URL."BibliotecarioCategoriaController/index");
        exit;

    }

    public function editar($id){

        $categoriaModel = $this->model('Categoria');

        $categoria = $categoriaModel->obtenerPorId($id);

        $this->view('bibliotecario/categorias/editar',[
            'categoria'=>$categoria
        ]);

    }

    public function actualizar(){

        $categoriaModel = $this->model('Categoria');

        $categoriaModel->actualizar(
            $_POST['id_categoria'],
            $_POST['categoria']
        );

        header("Location: ".BASE_URL."BibliotecarioCategoriaController/index");
        exit;

    }

    public function eliminar($id){

        $categoriaModel = $this->model('Categoria');

        $categoriaModel->eliminar($id);

        header("Location: ".BASE_URL."BibliotecarioCategoriaController/index");
        exit;

    }

}