<?php

class AdminController extends Controller {

    public function __construct(){

        if(session_status() === PHP_SESSION_NONE){

            session_start();

        }

        // si no hay sesión
        if(!isset($_SESSION['usuario'])){

            header("Location: ".BASE_URL."AuthController/login");

            exit;

        }

        // SOLO ADMINISTRADOR
        if($_SESSION['usuario']['id_rol'] != 1){

            echo "Acceso denegado";

            exit;

        }

    }


    public function index(){

        $this->view('admin/index');

    }

}