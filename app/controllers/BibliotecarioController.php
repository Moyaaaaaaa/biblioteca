<?php

class BibliotecarioController extends Controller {

    public function __construct(){

        if(session_status() === PHP_SESSION_NONE){
            session_start();
        }

        // Debe estar logueado
        if(!isset($_SESSION['usuario'])){
            header("Location: ".BASE_URL."AuthController/login");
            exit;
        }

        // SOLO BIBLIOTECARIO (id_rol = 5)
        if($_SESSION['usuario']['id_rol'] != 5){
            echo "Acceso denegado";
            exit;
        }
    }

    public function index(){
        $this->view('bibliotecario/index');
    }

    public function prestamosActivos(){

        $prestamoModel = $this->model('Prestamo');
        $prestamos = $prestamoModel->todosPrestamosActivos();

        $this->view('bibliotecario/prestamos',[
            'prestamos'=>$prestamos
        ]);
    }
}