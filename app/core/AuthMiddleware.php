<?php

class AuthMiddleware {

    public static function verificar(){

        // iniciar sesión si no está iniciada
        if(session_status() === PHP_SESSION_NONE){
            session_start();
        }

        // validar si existe usuario logueado
        if(!isset($_SESSION['usuario'])){

            header("Location: ".BASE_URL."AuthController/login");

            exit;

        }

    }

}