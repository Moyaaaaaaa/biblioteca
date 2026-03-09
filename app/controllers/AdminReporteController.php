<?php

class AdminReporteController extends Controller
{

    public function index()
    {

        $reporte = $this->model('Reporte');

        $data = [

            'inventario' => $reporte->inventario(),
            'prestados' => $reporte->librosMasPrestados(),
            'vencidos' => $reporte->prestamosVencidos(),
            'multas' => $reporte->usuariosMulta()

        ];

        $this->view('admin/reportes',$data);
    }
}