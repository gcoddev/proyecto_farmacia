<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categoria;

class CategoriaController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 5);
        $search = $request->input('search', null);

        $query = Categoria::query();

        if (!empty($search)) {
            $query->where('nombre_cat', 'like', "%{$search}%")
                ->orWhere('descripcion', 'like', "%{$search}%");
        }

        $categorias = $query->paginate($perPage);

        return view('backend.categorias.index', compact('categorias', 'perPage', 'search'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.categorias.nuevo');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
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

        $nuevaCategoria = new Categoria();
        $nuevaCategoria->nombre_cat = $request->nombre_cat;
        $nuevaCategoria->descripcion = $request->descripcion;
        $nuevaCategoria->save();

        return redirect()->route('categoria')->with('message', 'Categoría creada correctamente.');
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
        $categoria = Categoria::where('cod_categoria', $cod_categoria)->first();
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

        $categoria = Categoria::where('cod_categoria', $cod_categoria)->first();

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
        $categoria = Categoria::where('cod_categoria', $cod_categoria)->first();
        $categoria->delete();

        return redirect()->route('categoria')->with('message', 'Categoría eliminado correctamente.');
    }
}
