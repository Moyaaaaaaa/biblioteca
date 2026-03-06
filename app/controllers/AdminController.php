<?php

class AdminController extends Controller
{

public function __construct(){

if(session_status() === PHP_SESSION_NONE){
session_start();
}

if(!isset($_SESSION['usuario']) || $_SESSION['usuario']['id_rol'] != 1){
header("Location: ".BASE_URL."AuthController/login");
exit;
}

}

public function index(){

$this->view('admin/index');

}

}