<?php

namespace App\Http\Controllers;

use App\Models\Compra;
use App\Models\Venta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EstadisticaController extends Controller
{
    public function ventas()
    {
        $totalVentas = Venta::whereYear('fecha_venta', date('Y'))->sum('precio_total');
        $ventas = Venta::select(
            DB::raw('MONTH(fecha_venta) as mes'),
            DB::raw('SUM(precio_total) as total_ventas')
        )
            ->whereYear('fecha_venta', date('Y'))
            ->groupBy('mes')
            ->orderBy('mes', 'asc')
            ->get();

        $ventasPorMes = array_fill(1, 12, 0);
        foreach ($ventas as $venta) {
            $ventasPorMes[$venta->mes] = $venta->total_ventas;
        }

        $valorMaximo = max($ventasPorMes);

        $yValues = [];
        for ($i = 0; $i <= 5; $i++) {
            $yValues[] = round($valorMaximo * (1 - 0.2 * $i), 2);
        }

        $inicioSemana = now()->startOfWeek(); // Domingo
        $finSemana = now()->endOfWeek(); // Sábado

        $ventasSemana = Venta::select(
            DB::raw('DAYOFWEEK(fecha_venta) as dia'),
            DB::raw('SUM(precio_total) as total_ventas')
        )
            ->whereBetween('fecha_venta', [$inicioSemana, $finSemana])
            ->groupBy('dia')
            ->orderBy('dia')
            ->get();

        $ventasPorDia = array_fill(1, 7, 0);
        foreach ($ventasSemana as $venta) {
            $ventasPorDia[$venta->dia] = $venta->total_ventas;
        }

        $valorMaximoDia = max($ventasPorDia);
        // dd($valorMaximoDia);

        $ventasPorCategoria = Venta::select(
            'categorias.nombre_cat as categoria',
            DB::raw('SUM(ventas.cantidad) as total_cantidad')
        )
            ->join('productos', 'ventas.cod_producto', '=', 'productos.cod_producto')
            ->join('categorias', 'productos.cod_categoria', '=', 'categorias.cod_categoria')
            ->groupBy('categorias.nombre_cat')
            ->orderBy('categorias.nombre_cat')
            ->get();

        // Colores alternados basados en los colores hexadecimales de Bootstrap
        $coloresBootstrap = ['#0d6efd', '#6c757d', '#ffc107', '#0dcaf0', '#dc3545', '#212529', '#f8f9fa'];
        $colores = [];
        foreach ($ventasPorCategoria as $index => $venta) {
            $colores[] = $coloresBootstrap[$index % count($coloresBootstrap)];
        }

        $totalGeneral = $ventasPorCategoria->sum('total_cantidad');

        // Calcular porcentajes
        $datosPorCategoria = $ventasPorCategoria->map(function ($item) use ($totalGeneral) {
            $item->porcentaje = $totalGeneral > 0 ? ($item->total_cantidad / $totalGeneral) * 100 : 0;
            return $item;
        });

        $codigos = Venta::with(['cliente', 'producto'])
            ->orderBy('codigo', 'desc')
            ->get();

        $ventasAgrupadas = $codigos->groupBy('codigo')->map(function ($grupo) {
            return [
                'cliente' => $grupo->first()->cliente,
                'total_precio' => $grupo->sum('precio_total'),
                'productos' => $grupo,
                'fecha_venta' => $grupo->first()->fecha_venta
            ];
        });

        return view('backend.estadisticas.ventas', [
            'ventas' => $totalVentas,
            'ventasPorMes' => array_values($ventasPorMes),
            'yValues' => $yValues,
            'ventasPorDia' => array_values($ventasPorDia),
            'valorMaximo' => $valorMaximoDia,
            'categorias' => $ventasPorCategoria->pluck('categoria'),
            'valores' => $ventasPorCategoria->pluck('total_cantidad'),
            'colores' => $colores,
            'topCategorias' => $datosPorCategoria,
            'ventasAgrupadas' => $ventasAgrupadas
        ]);
    }
    public function compras()
    {
        $totalCompras = Compra::whereYear('fecha_compra', date('Y'))->sum('monto_total');

        $comprasMeses = DB::table('compras')
            ->selectRaw('MONTH(fecha_compra) as mes, SUM(monto_total) as total')
            ->whereYear('fecha_compra', date('Y'))
            ->groupByRaw('MONTH(fecha_compra)')
            ->orderBy('mes')
            ->get();

        $comprasOrden = array_fill(0, 12, 0);

        foreach ($comprasMeses as $compra) {
            $comprasOrden[$compra->mes - 1] = (float)$compra->total;
        }

        $comprasProveedores = DB::table('compras')
            ->join('proveedores', 'compras.cod_proveedor', '=', 'proveedores.cod_proveedor')
            ->selectRaw('proveedores.nombre_prov as proveedor, COUNT(compras.cod_compra) as total')
            ->whereYear('compras.fecha_compra', date('Y'))
            ->groupBy('proveedores.nombre_prov')
            ->orderBy('total', 'desc')
            ->get();

        $proveedoresNombres = $comprasProveedores->pluck('proveedor')->toArray();
        $proveedoresTotales = $comprasProveedores->pluck('total')->toArray();

        $colores = ['#487FFF', '#FF1255', '#FF7512', '#0dcaf0', '#ffc107', '#198754', '#6c757d'];
        $coloresProveedores = array_slice($colores, 0, count($proveedoresNombres)); // Ajustar cantidad

        $totalCompras2 = DB::table('compras')
            ->whereYear('fecha_compra', date('Y'))
            ->count();

        // Obtener compras por proveedor con el cálculo del porcentaje
        $comprasPorProveedor = DB::table('compras')
            ->join('proveedores', 'compras.cod_proveedor', '=', 'proveedores.cod_proveedor')
            ->selectRaw(
                'proveedores.nombre_prov as proveedor,
                 COUNT(compras.cod_compra) as total,
                 (COUNT(compras.cod_compra) * 100 / ?) as porcentaje',
                [$totalCompras2]
            )
            ->whereYear('compras.fecha_compra', date('Y'))
            ->groupBy('proveedores.nombre_prov')
            ->orderBy('total', 'desc')
            ->get();

        $comprasAgrupadas = Compra::orderBy('cod_compra', 'desc')->get();

        return view('backend.estadisticas.compras', compact(
            'totalCompras',
            'comprasOrden',
            'proveedoresNombres',
            'proveedoresTotales',
            'coloresProveedores',
            'comprasPorProveedor',
            'comprasAgrupadas'
        ));
    }
}
