<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Compra;
use App\Models\Proveedor;
use App\Models\User;
use App\Models\Venta;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $users = User::where('estado', '<>', 'ELIMINADO')->count();
        $clientes = Cliente::count();
        $proveedores = Proveedor::count();

        $ventas = Venta::sum('precio_total');
        $compras = Compra::join('productos as p', 'p.cod_producto', '=', 'compras.cod_producto')
            ->sum('p.precio_caja');

        $codigos = Venta::with(['cliente', 'producto'])
            ->orderBy('codigo', 'desc')
            ->get();

        // Agrupar por 'codigo'
        $ventasAgrupadas = $codigos->groupBy('codigo')->map(function ($grupo) {
            return [
                'cliente' => $grupo->first()->cliente,
                'total_precio' => $grupo->sum('precio_total'),
                'productos' => $grupo,
                'fecha_venta' => $grupo->first()->fecha_venta
            ];
        });

        $comprasAgrupadas = Compra::orderBy('cod_compra', 'desc')->get();

        return view('backend.dashboard', compact('users', 'clientes', 'proveedores', 'ventas', 'compras', 'ventasAgrupadas', 'comprasAgrupadas'));
    }
}
