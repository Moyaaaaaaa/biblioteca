<?php

class NotificacionController extends Controller {

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

        $modelo = $this->model('Notificacion');
        $notificaciones = $modelo->obtenerPorUsuario($_SESSION['usuario']['id_usuario']);

        $this->view('usuario/notificaciones',[
            'notificaciones'=>$notificaciones
        ]);
    }
}