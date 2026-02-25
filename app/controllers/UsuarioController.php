<?php

class UsuarioController extends Controller {

    public function index(){

        $usuarioModel = $this->model('Usuario');

        $usuarios = $usuarioModel->obtenerTodos();

        $this->view('usuario/index',[
            'usuarios'=>$usuarios
        ]);

    }

    public function create(){

        $usuarioModel = $this->model('Usuario');

        $roles = $usuarioModel->obtenerRoles();

        $this->view('usuario/create',[
            'roles'=>$roles
        ]);

    }

}