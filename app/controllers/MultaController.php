<?php

class MultaController extends Controller {

    public function __construct(){

        if(session_status() === PHP_SESSION_NONE){
            session_start();
        }

        if(!isset($_SESSION['usuario'])){
            header("Location: ".BASE_URL."AuthController/login");
            exit;
        }
    }

    public function misMultas(){

        $multaModel = $this->model('Multa');

        $multas = $multaModel->multasUsuario(
            $_SESSION['usuario']['id_usuario']
        );

        $this->view('usuario/multas',[
            'multas' => $multas
        ]);
    }
}