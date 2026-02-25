<?php

class DashboardController extends Controller {

    public function index(){

        if(session_status() === PHP_SESSION_NONE){
            session_start();
        }

        // bloquear acceso directo
        if(!isset($_SESSION['usuario'])){

            header("Location: ".BASE_URL."AuthController/login");

            exit;

        }

        $this->view('dashboard/index');

    }

}