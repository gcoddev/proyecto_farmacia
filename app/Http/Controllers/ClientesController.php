<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;

class ClientesController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 10);
        $search = $request->input('search', null);

        $query = Cliente::query();

        if (!empty($search)) {
            $query->where('nombre_cli', 'like', "%{$search}%")
                // ->orWhere('apellidos', 'like', "%{$search}%")
                ->orWhere('diagnostico', 'like', "%{$search}%")
                ->orWhere('telefono', 'like', "%{$search}%")
                ->orWhere('direccion', 'like', "%{$search}%");
        }

        $clientes = $query->paginate($perPage);

        return view('backend.clientes.index', compact('clientes', 'perPage', 'search'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.clientes.nuevo');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request);
        // die();
        $request->validate([
            'nombre_cli' => 'required|min:3',
            'diagnostico' => 'nullable',
            'telefono' => 'nullable',
            'direccion' => 'nullable',
        ], [
            // Mensajes de validaciones
            'nombre_cli.required' => 'El nombre es obligatorio.',
            'nombre_cli.min' => 'El nombre debe tener al menos 3 caracteres.'
        ]);

        $nuevoCliente = new Cliente();
        $nuevoCliente->nombre_cli = $request->nombre_cli;
        $nuevoCliente->diagnostico = $request->diagnostico;
        $nuevoCliente->telefono = $request->telefono;
        $nuevoCliente->direccion = $request->direccion;
        $nuevoCliente->save();

        return redirect()->route('cliente')->with('message', 'Cliente creado correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $cod_cliente)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $cod_cliente)
    {
        $cliente = Cliente::where('cod_cliente', $cod_cliente)->first();
        return view('backend.clientes.nuevo', compact('cliente'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $cod_cliente)
    {
        // dd($request);
        // die();
        $request->validate([
            'nombre_cli' => 'required|min:3',
            'diagnostico' => 'nullable',
            'telefono' => 'nullable',
            'direccion' => 'nullable',
        ], [
            // Mensajes de validaciones
            'nombre_cli.required' => 'El nombre es obligatorio.',
            'nombre_cli.min' => 'El nombre debe tener al menos 3 caracteres.'
        ]);

        $cliente = Cliente::where('cod_cliente', $cod_cliente)->first();

        $cliente->nombre_cli = $request->nombre_cli;
        $cliente->diagnostico = $request->diagnostico;
        $cliente->telefono = $request->telefono;
        $cliente->direccion = $request->direccion;
        $cliente->save();

        return redirect()->route('cliente')->with('message', 'Cliente actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $cod_cliente)
    {
        $cliente = Cliente::where('cod_cliente', $cod_cliente)->first();
        $cliente->delete();

        return redirect()->route('cliente')->with('message', 'Cliente eliminado correctamente.');
    }
}
