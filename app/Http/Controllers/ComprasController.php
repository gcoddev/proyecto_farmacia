<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Compra;
use App\Models\PrecioCompra;
use App\Models\Producto;
use App\Models\Proveedor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Carbon\Carbon;

class ComprasController extends Controller
{
    public function index(Request $request)
    {
        $per_page = $request->input('per_page', 10);

        $compras = Compra::orderBy('cod_compra', 'desc')->paginate($per_page);

        return view('backend.compras.index', compact('compras', 'per_page'));
    }

    public function create()
    {
        $categorias = Categoria::all();
        $productos = Producto::all();
        $proveedores = Proveedor::all();
        return view('backend.compras.nuevo', compact('categorias', 'productos', 'proveedores'));
    }

    public function store(Request $request)
    {
        // dd($request);
        // die();
        $request->validate([
            'opt' => 'required',
            'opt2' => 'required',
            'cantidad_compra' => 'required',
            'fecha_caducidad' => 'nullable',
            'precio_unitario' => 'required',
            'stock' => 'required',
            'monto_total' => 'required',
        ], [
            'opt.required' => 'El producto es requerido',
            'opt2.required' => 'El proveedor es requerido',
            'cantidad_compra.required' => 'Cantidad requerida',
            'fecha_caducidad.nullable' => 'Fecha de caducidad requerida',
            'precio_unitario.required' => 'El precio comercial es requerido',
            'stock.required' => 'Stock requerido',
            'monto_total.required' => 'El monto total requerido',
        ]);

        $producto = null;
        if ($request->opt == 'nuevo') {
            $request->validate([
                'nombre_prod' => 'required|min:3',
                'precio' => 'required|numeric|regex:/^\d+(\.\d{1,2})?$/',
                'precio_caja' => 'required|numeric|regex:/^\d+(\.\d{1,2})?$/',
                'presentacion' => 'required',
                'cantidad' => 'required',
                'cod_categoria' => 'required'
            ], [
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
                'cod_categoria.required' => 'La categoría es obligatoria.',
            ]);

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

            $nuevoProducto = new Producto();
            $nuevoProducto->nombre_prod = $request->nombre_prod;
            $nuevoProducto->precio = $request->precio;
            $nuevoProducto->precio_caja = $request->precio_caja;
            $nuevoProducto->presentacion = $request->presentacion;
            $nuevoProducto->cantidad = $request->cantidad;
            $nuevoProducto->cod_categoria = $request->cod_categoria;
            $nuevoProducto->save();

            $producto = $nuevoProducto;
        } else {
            $request->validate([
                'cod_producto' => 'required'
            ], [
                'cod_producto.required' => 'El producto es requerido'
            ]);

            $producto = Producto::where('cod_producto', $request->cod_producto)->first();
        }

        $proveedor = null;
        if ($request->opt2 == 'nuevo') {
            $request->validate([
                'nombre_prov' => 'required|min:3',
                'telefono' => 'nullable',
                'direccion' => 'nullable',
            ], [
                'nombre_prov.required' => 'El nombre es obligatorio.',
                'nombre_prov.min' => 'El nombre debe tener al menos 3 caracteres.'
            ]);

            $nuevoProveedor = new Proveedor();
            $nuevoProveedor->nombre_prov = $request->nombre_prov;
            $nuevoProveedor->telefono = $request->telefono;
            $nuevoProveedor->direccion = $request->direccion;
            $nuevoProveedor->save();

            $proveedor = $nuevoProveedor;
        } else {
            $request->validate([
                'cod_proveedor' => 'required'
            ], [
                'cod_proveedor.required' => 'El producto es requerido'
            ]);

            $proveedor = Proveedor::where('cod_proveedor', $request->cod_proveedor)->first();
        }

        $nuevaCompra = new Compra();
        $nuevaCompra->cod_proveedor = $proveedor->cod_proveedor;
        $nuevaCompra->cod_usuario = Auth::user()->cod_usuario;
        $nuevaCompra->cod_producto = $producto->cod_producto;
        $nuevaCompra->cantidad = $request->cantidad_compra;
        $nuevaCompra->fecha_compra = new \DateTime();
        $nuevaCompra->monto_total = $request->monto_total;
        $nuevaCompra->save();

        $nuevoStock = new PrecioCompra();
        $nuevoStock->cod_compra = $nuevaCompra->cod_compra;
        $nuevoStock->cod_producto = $producto->cod_producto;
        $nuevoStock->precio_unitario = $request->precio_unitario;
        $nuevoStock->stock = $request->stock;
        $nuevoStock->fecha_caducidad = $request->fecha_caducidad ? $request->fecha_caducidad . '-01' : null;
        $nuevoStock->save();

        return redirect()->route('compra')->with('message', 'Compra realizada con éxito.');
    }
}
