<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EstadisticaController extends Controller
{
    public function ventas()
    {
        return view('backend.estadisticas.ventas');
    }
    public function compras()
    {
        return view('backend.estadisticas.compras');
    }
}
