<?php

class BibliotecarioAutorController extends Controller {

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

        $autorModel = $this->model('Autor');

        $autores = $autorModel->listarAutores();

        $this->view('bibliotecario/autores/index',[
            'autores'=>$autores
        ]);

    }

    public function crear(){

        $this->view('bibliotecario/autores/crear');

    }

    public function guardar(){

        $autorModel = $this->model('Autor');

        $autorModel->crear(
            $_POST['nombre'],
            $_POST['apellido_paterno'],
            $_POST['apellido_materno'],
            $_POST['nacionalidad']
        );

        header("Location: ".BASE_URL."BibliotecarioAutorController/index");
        exit;

    }

    public function editar($id){

        $autorModel = $this->model('Autor');

        $autor = $autorModel->obtener($id);

        $this->view('bibliotecario/autores/editar',[
            'autor'=>$autor
        ]);

    }

    public function actualizar(){

        $autorModel = $this->model('Autor');

        $autorModel->actualizar(
            $_POST['id_autor'],
            $_POST['nombre'],
            $_POST['apellido_paterno'],
            $_POST['apellido_materno'],
            $_POST['nacionalidad']
        );

        header("Location: ".BASE_URL."BibliotecarioAutorController/index");
        exit;

    }

    public function eliminar($id){

        $autorModel = $this->model('Autor');

        $autorModel->eliminar($id);

        header("Location: ".BASE_URL."BibliotecarioAutorController/index");
        exit;

    }

}