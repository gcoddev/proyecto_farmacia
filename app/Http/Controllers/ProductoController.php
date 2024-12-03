<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\Categoria;

class ProductoController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 5);
        $search = $request->input('search', null);

        $query = Producto::query();

        if (!empty($search)) {
            $query->where('nombre_prod', 'like', "%{$search}%")
                ->orWhere('precio', 'like', "%{$search}%")
                ->orWhere('stock', 'like', "%{$search}%")
                ->orWhere('fecha_caducidad', 'like', "%{$search}%");
        }

        $productos = $query->paginate($perPage);

        return view('backend.productos.index', compact('productos', 'perPage', 'search'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categorias = Categoria::all();

        return view('backend.productos.nuevo', compact('categorias'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request);
        // die();
        $request->validate([
            'nombre_prod' => 'required|min:3',
            'precio' => 'required|numeric|regex:/^\d+(\.\d{1,2})?$/',
            'precio_caja' => 'required|numeric|regex:/^\d+(\.\d{1,2})?$/',
            'presentacion' => 'required',
            'cantidad' => 'required',
            // 'fecha_caducidad' => 'required|date',
            'cod_categoria' => 'required'
        ], [
            // Mensajes de validaciones
            'nombre_prod.required' => 'El nombre es obligatorio.',
            'nombre_prod.min' => 'El nombre debe tener al menos 3 caracteres.',
            'precio.required' => 'El precio es obligatorio.',
            'precio.numeric' => 'El precio debe ser un número.',
            'precio.regex' => 'El precio debe ser un precio valido.',
            'precio_caja.required' => 'El precio de caja es obligatorio.',
            'precio_caja.numeric' => 'El precio debe ser un número.',
            'precio_caja.regex' => 'El precio debe ser un precio valido.',
            'presentacion.required' => 'La presentación es obligatorio.',
            'cantidad.required' => 'La cantidad es obligatorio.',
            // 'fecha_caducidad.required' => 'La fecha de caducidad es obligatoria.',
            // 'fecha_caducidad.date' => 'La fecha de caducidad debe ser una fecha válida.',
            'cod_categoria.required' => 'La categoría es obligatoria.',
        ]);

        // $caja = null;
        // if (preg_match('/\d+/', $request->presentacion, $matches)) {
        //     $caja = intval($matches[0]);
        // } else {
        //     $caja = 1;
        // }

        // $unidad = null;
        // if (preg_match('/\d+/', $request->cantidad, $matches)) {
        //     $unidad = intval($matches[0]);
        // } else {
        //     $unidad = 1;
        // }

        // $stock = $caja * $unidad;

        if ($request->cod_categoria == 'otro') {
            $request->validate([
                'nombre_otro_cat' => 'required|min:3',
            ], [
                // Mensajes de validaciones
                'nombre_otro_cat.required' => 'El nombre de la categoría es obligatorio.',
                'nombre_otro_cat.min' => 'El nombre de la categoría debe tener al menos 3 caracteres.',
            ]);

            $nuevaCategoria = new Categoria();
            $nuevaCategoria->nombre_cat = $request->nombre_otro_cat;
            $nuevaCategoria->save();
            $request->merge(['cod_categoria' => $nuevaCategoria->cod_categoria]);
        }

        // Guardar el registro de producto
        $nuevoProducto = new Producto();
        $nuevoProducto->nombre_prod = $request->nombre_prod;
        $nuevoProducto->precio = $request->precio;
        $nuevoProducto->precio_caja = $request->precio_caja;
        $nuevoProducto->presentacion = $request->presentacion;
        $nuevoProducto->cantidad = $request->cantidad;
        // $nuevoProducto->stock = 0;
        // $nuevoProducto->fecha_caducidad = $request->fecha_caducidad;
        $nuevoProducto->cod_categoria = $request->cod_categoria;
        $nuevoProducto->save();

        return redirect()->route('producto')->with('message', 'Producto creado correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $cod_producto)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $cod_producto)
    {
        $producto = Producto::where('cod_producto', $cod_producto)->first();
        $categorias = Categoria::all();

        return view('backend.productos.nuevo', compact('producto', 'categorias'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $cod_producto)
    {
        // dd($request);
        // die();
        $request->validate([
            'nombre_prod' => 'required|min:3',
            'precio' => 'required|numeric|regex:/^\d+(\.\d{1,2})?$/',
            'stock' => 'required|integer|min:1',
            'fecha_caducidad' => 'required|date',
            'cod_categoria' => 'required|exists:categorias,cod_categoria'
        ], [
            // Mensajes de validaciones
            'nombre_prod.required' => 'El nombre es obligatorio.',
            'nombre_prod.min' => 'El nombre debe tener al menos 3 caracteres.',
            'precio.required' => 'El precio es obligatorio.',
            'precio.numeric' => 'El precio debe ser un número.',
            'precio.floatval' => 'El precio debe ser un precio valido.',
            'stock.required' => 'El stock es obligatorio.',
            'stock.integer' => 'El stock debe ser un número entero.',
            'stock.min' => 'El stock debe ser mayor o igual a 1.',
            'fecha_caducidad.required' => 'La fecha de caducidad es obligatoria.',
            'fecha_caducidad.date' => 'La fecha de caducidad debe ser una fecha válida.',
            'cod_categoria.required' => 'La categoría es obligatoria.',
        ]);


        $producto = Producto::where('cod_producto', $cod_producto)->first();
        $producto->nombre_prod = $request->nombre_prod;
        $producto->precio = $request->precio;
        $producto->stock = $request->stock;
        $producto->fecha_caducidad = $request->fecha_caducidad;
        $producto->cod_categoria = $request->cod_categoria;
        $producto->save();

        return redirect()->route('producto')->with('message', 'Producto actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $cod_producto)
    {
        $producto = Producto::where('cod_producto', $cod_producto)->first();
        $producto->delete();

        return redirect()->route('producto')->with('message', 'Producto eliminado correctamente.');
    }
}
