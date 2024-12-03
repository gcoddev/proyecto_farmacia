<?php

namespace App\Http\Controllers;

use App\Models\Compra;
use Illuminate\Http\Request;
use App\Models\Venta;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

class ReporteController extends Controller
{
    public function ventas()
    {
        $ventasAgrupadas = Venta::select('codigo')
            ->distinct()
            ->orderBy('codigo', 'desc')
            ->get()
            ->mapWithKeys(function ($item) {
                $grupo = Venta::with(['cliente', 'producto'])
                    ->where('codigo', $item->codigo)
                    ->get();

                return [
                    $item->codigo => [
                        'cliente' => $grupo->first()->cliente,
                        'total_precio' => $grupo->sum('precio_total'),
                        'productos' => $grupo,
                        'fecha_venta' => $grupo->first()->fecha_venta,
                    ],
                ];
            });

        $pdf = Pdf::loadView('backend.reportes.ventas', ['ventasAgrupadas' => $ventasAgrupadas]);

        // return $pdf->download('ventas.pdf');
        return $pdf->stream('ventas.pdf');
    }

    public function compras()
    {
        $compras = Compra::with(['producto', 'proveedor', 'precio'])
            ->orderBy('cod_compra', 'desc')
            ->get();

        $pdf = Pdf::loadView('backend.reportes.compras', compact('compras'));

        return $pdf->stream('compras.pdf');
    }
}
