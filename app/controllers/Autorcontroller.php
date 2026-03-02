<?php

class AutorController extends Controller {

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

        $autorModel = $this->model('Autor');
        $autores = $autorModel->listarAutores();

        $this->view('usuario/autores',[
            'autores'=>$autores
        ]);
    }
}