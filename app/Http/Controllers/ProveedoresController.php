<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Proveedor;

class ProveedoresController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 5);
        $search = $request->input('search', null);

        $query = Proveedor::query();

        if (!empty($search)) {
            $query->where('nombre_prov', 'like', "%{$search}%")
                // ->orWhere('apellidos', 'like', "%{$search}%")
                ->orWhere('telefono', 'like', "%{$search}%")
                ->orWhere('direccion', 'like', "%{$search}%");
        }

        $proveedores = $query->paginate($perPage);

        return view('backend.proveedores.index', compact('proveedores', 'perPage', 'search'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.proveedores.nuevo');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request);
        // die();
        $request->validate([
            'nombre_prov' => 'required|min:3',
            'telefono' => 'nullable',
            'direccion' => 'nullable',
        ], [
            // Mensajes de validaciones
            'nombre_prov.required' => 'El nombre es obligatorio.',
            'nombre_prov.min' => 'El nombre debe tener al menos 3 caracteres.'
        ]);

        $nuevoProveedor = new Proveedor();
        $nuevoProveedor->nombre_prov = $request->nombre_prov;
        $nuevoProveedor->telefono = $request->telefono;
        $nuevoProveedor->direccion = $request->direccion;
        $nuevoProveedor->save();

        return redirect()->route('proveedor')->with('message', 'Proveedor creado correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $cod_proveedor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $cod_proveedor)
    {
        $proveedor = Proveedor::where('cod_proveedor', $cod_proveedor)->first();
        return view('backend.proveedores.nuevo', compact('proveedor'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $cod_proveedor)
    {
        // dd($request);
        // die();
        $request->validate([
            'nombre_prov' => 'required|min:3',
            'telefono' => 'nullable',
            'direccion' => 'nullable',
        ], [
            // Mensajes de validaciones
            'nombre_prov.required' => 'El nombre es obligatorio.',
            'nombre_prov.min' => 'El nombre debe tener al menos 3 caracteres.'
        ]);

        $cliente = Proveedor::where('cod_proveedor', $cod_proveedor)->first();

        $cliente->nombre_prov = $request->nombre_prov;
        $cliente->telefono = $request->telefono;
        $cliente->direccion = $request->direccion;
        $cliente->save();

        return redirect()->route('proveedor')->with('message', 'Proveedor actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $cod_proveedor)
    {
        $cliente = Proveedor::where('cod_proveedor', $cod_proveedor)->first();
        $cliente->delete();

        return redirect()->route('proveedor')->with('message', 'Proveedor eliminado correctamente.');
    }
}
