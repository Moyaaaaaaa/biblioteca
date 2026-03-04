<?php

class CategoriaController extends Controller {

    public function __construct(){

        if(session_status() === PHP_SESSION_NONE){
            session_start();
        }

        if(!isset($_SESSION['usuario'])){
            header("Location: ".BASE_URL."AuthController/login");
            exit;
        }

    }

    public function index(){

        $categoriaModel = $this->model('Categoria');

        $categorias = $categoriaModel->todas();

        $this->view('usuario/categorias',[
            'categorias'=>$categorias
        ]);

    }

    public function ver($id){

        $categoriaModel = $this->model('Categoria');

        $libros = $categoriaModel->librosPorCategoria($id);

        $this->view('usuario/libros_categoria',[
            'libros'=>$libros
        ]);

    }

}