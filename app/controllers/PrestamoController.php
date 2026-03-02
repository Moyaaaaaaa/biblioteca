<?php

class PrestamoController extends Controller {

    public function __construct(){

        if(session_status() === PHP_SESSION_NONE){
            session_start();
        }

        if(!isset($_SESSION['usuario'])){
            header("Location: ".BASE_URL."AuthController/login");
            exit;
        }
    }

    public function misPrestamos(){

        $prestamoModel = $this->model('Prestamo');

        $prestamos = $prestamoModel->prestamosUsuario(
            $_SESSION['usuario']['id_usuario']
        );

        $this->view('usuario/prestamos',[
            'prestamos' => $prestamos
        ]);
    }
    public function crear(){

    if(!isset($_POST['id_libro'])){
        header("Location: ".BASE_URL."LibroController/catalogo");
        exit;
    }

    $id_libro = $_POST['id_libro'];
    $id_usuario = $_SESSION['usuario']['id_usuario'];

    $prestamoModel = $this->model('Prestamo');

    $resultado = $prestamoModel->crearPrestamo($id_usuario, $id_libro);

    header("Location: ".BASE_URL."PrestamoController/misPrestamos");
    exit;
    }
}
