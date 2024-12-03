<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Informacion;
use App\Models\PrecioCompra;
use Illuminate\Http\Request;
use App\Models\Venta;
use Illuminate\Support\Facades\DB;
use App\Models\Producto;

class VentasController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 5);

        $codigos = Venta::select('codigo')
            ->distinct()
            ->groupBy('codigo')
            ->orderBy('codigo', 'desc')
            ->paginate($perPage);

        $ventasAgrupadas = $codigos->getCollection()->mapWithKeys(function ($item) {
            $grupo = Venta::with(['cliente', 'producto'])
                ->where('codigo', $item->codigo)
                ->get();

            return [
                $item->codigo => [
                    'cliente' => $grupo->first()->cliente,
                    'total_precio' => $grupo->sum('precio_total'),
                    'productos' => $grupo,
                    'fecha_venta' => $grupo->first()->fecha_venta
                ]
            ];
        });

        return view('backend.ventas.index', [
            'ventasAgrupadas' => $ventasAgrupadas,
            'ventas' => $codigos,
            'perPage' => $perPage
        ]);

        // return view('backend.ventas.index', compact('ventas', 'perPage'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $cod = Venta::orderBy('codigo', 'desc')->first();
        $old = 0;
        if ($cod) {
            $old = $cod->codigo + 1;
        } else {
            $old = 1;
        }
        $fecha = \Date('d-m-Y');

        // $productos = Producto::get();
        $productos = PrecioCompra::join('productos as p', 'p.cod_producto', '=', 'precio_compras.cod_producto')
            ->where('precio_compras.stock', '>', 0)
            ->orderBy('precio_compras.fecha_caducidad', 'ASC')
            ->get();
        // dd($productos);
        $clientes = Cliente::get();
        $info = Informacion::first();

        return view('backend.ventas.nuevo', compact('old', 'fecha', 'clientes', 'productos', 'info'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request);
        // die();
        $cliente = $request->cod_cliente;

        if (!isset($request->cod_cliente)) {
            if (isset($request->nombre_cli)) {
                $nuevoCliente = new Cliente();
                $nuevoCliente->nombre_cli = $request->nombre_cli;
                $nuevoCliente->telefono = $request->telefono;
                $nuevoCliente->direccion = $request->direccion;
                $nuevoCliente->diagnostico = $request->diagnostico;
                $nuevoCliente->save();

                $cliente = $nuevoCliente->cod_cliente;
            }
        }

        foreach ($request->productos as $key => $prod) {
            $producto = Producto::whereRaw('? like concat(nombre_prod, "%")', [$prod])->first();

            if ($producto && $request->cantidades[$key]) {
                $nuevaVenta = new Venta();
                $nuevaVenta->codigo = $request->codigo;
                $nuevaVenta->cod_cliente = $cliente;
                $nuevaVenta->cod_producto = $producto->cod_producto;
                $nuevaVenta->cantidad = $request->cantidades[$key];
                $nuevaVenta->precio_unitario = $request->precios[$key];
                $nuevaVenta->precio_total = $request->preciosTotales[$key];
                $nuevaVenta->fecha_venta = new \DateTime();
                $nuevaVenta->save();

                $venta = PrecioCompra::where('cod_precio_compra', $request->ids[$key])->first();
                $venta->stock = $venta->stock - $request->cantidades[$key];
                $venta->save();
            }
        }

        return back()->with('message', 'Venta realizada correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $cod_categoria)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $cod_categoria)
    {
        $categoria = Venta::where('cod_categoria', $cod_categoria)->first();
        return view('backend.categorias.nuevo', compact('categoria'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $cod_categoria)
    {
        // dd($request);
        // die();
        $request->validate([
            'nombre_cat' => 'required|min:3',
        ], [
            // Mensajes de validaciones
            'nombre_cat.required' => 'El nombre es obligatorio.',
            'nombre_cat.min' => 'El nombre debe tener al menos 3 caracteres.'
        ]);

        $categoria = Venta::where('cod_categoria', $cod_categoria)->first();

        $categoria->nombre_cat = $request->nombre_cat;
        $categoria->descripcion = $request->descripcion;
        $categoria->save();

        return redirect()->route('categoria')->with('message', 'Categoría actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $cod_categoria)
    {
        $categoria = Venta::where('cod_categoria', $cod_categoria)->first();
        $categoria->delete();

        return redirect()->route('categoria')->with('message', 'Categoría eliminado correctamente.');
    }

    public function buscar(Request $request)
    {
        return Cliente::where('nombre_cli', 'like', "%{$request->nombre}%")->first();
    }
}
