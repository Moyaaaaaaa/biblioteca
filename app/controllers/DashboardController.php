<?php

class DashboardController extends Controller {

    public function index(){

        // iniciar sesión solo si no existe
        if(session_status() === PHP_SESSION_NONE){

            session_start();

        }

        // proteger dashboard
        if(!isset($_SESSION['usuario'])){

            header("Location: ".BASE_URL."AuthController/login");

            exit;

        }

        echo "Bienvenido al Dashboard";

        echo "<a href='".BASE_URL."AuthController/logout'>Cerrar sesión</a>";

    }

}