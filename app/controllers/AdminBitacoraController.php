<?php

class AdminBitacoraController extends Controller
{

    public function index()
    {

        $bitacoraModel = $this->model('Bitacora');

        $registros = $bitacoraModel->obtenerTodo();

        $this->view('admin/bitacora', [
            'registros' => $registros
        ]);
    }
}