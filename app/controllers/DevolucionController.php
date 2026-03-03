<?php

class DevolucionController extends Controller {

    public function __construct(){

        if(session_status() === PHP_SESSION_NONE){
            session_start();
        }

        if(!isset($_SESSION['usuario'])){
            header("Location: ".BASE_URL."AuthController/login");
            exit;
        }
    }

    public function misDevoluciones(){

        $devolucionModel = $this->model('Devolucion');

        $devoluciones = $devolucionModel->devolucionesUsuario(
            $_SESSION['usuario']['id_usuario']
        );

        $this->view('usuario/devoluciones',[
            'devoluciones' => $devoluciones
        ]);
    }

    public function devolver(){

    if(!isset($_POST['id_prestamo'])){
        header("Location: ".BASE_URL."PrestamoController/misPrestamos");
        exit;
    }

    $id_prestamo = $_POST['id_prestamo'];

    $devolucionModel = $this->model('Devolucion');
    $devolucionModel->procesarDevolucion($id_prestamo);

    header("Location: ".BASE_URL."PrestamoController/misPrestamos");
    exit;
}
}