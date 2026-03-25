<?php

class AuthMiddleware {

    public static function verificar(){

        if(session_status() === PHP_SESSION_NONE){
            session_start();
        }

        if(!isset($_SESSION['usuario'])){

            header("Location: ".BASE_URL."AuthController/login");

            exit;

        }

    }

}