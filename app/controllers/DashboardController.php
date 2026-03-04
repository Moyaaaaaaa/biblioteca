<?php

class DashboardController extends Controller
{

    public function index()
    {

        $multaModel = $this->model('Multa');

        $multasPendientes = $multaModel->multasUsuarioPendientes(
            $_SESSION['usuario']['id_usuario']
        );

        $this->view('usuario/index', [
            'multasPendientes' => $multasPendientes
        ]);

    }

}