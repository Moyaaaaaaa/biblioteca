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

public function index(){

$multaModel=$this->model('Multa');

$multas=$multaModel->todas();

$this->view('bibliotecario/multas',[
'multas'=>$multas
]);

}

public function pagar(){

$id_multa=$_POST['id_multa'];

$multaModel=$this->model('Multa');

$multaModel->pagar($id_multa);

header("Location: ".BASE_URL."MultaController/index");

}

public function misMultas(){

$multaModel=$this->model('Multa');

$multas=$multaModel->multasUsuario(
$_SESSION['usuario']['id_usuario']
);

$this->view('usuario/multas',[
'multas'=>$multas
]);

}

}