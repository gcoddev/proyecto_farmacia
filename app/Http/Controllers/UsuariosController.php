<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UsuariosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 5);
        $search = $request->input('search', null);
        $status = $request->input('status', null);

        $query = User::query();

        if (!empty($search)) {
            $query->where('nombres', 'like', "%{$search}%")
                ->orWhere('apellidos', 'like', "%{$search}%")
                ->orWhere('username', 'like', "%{$search}%")
                ->orWhere('email', 'like', "%{$search}%");
        }

        if (!empty($status) && in_array($status, ['ACTIVO', 'INACTIVO'])) {
            $query->where('estado', $status);
        }

        $usuarios = $query->paginate($perPage);

        return view('backend.usuarios.index', compact('usuarios', 'perPage', 'search', 'status'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.usuarios.nuevo');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request);
        // die();
        $request->validate([
            'nombres' => 'required|min:3',
            'apellidos' => 'required|min:3',
            // validate image for files png, jpeg and jpg
            'image' => 'nullable|file|image|mimes:png,jpeg,jpg',
            'email' => 'nullable|email',
            'username' => 'required|min:3|unique:users,username',
            'password' => 'required|min:5',
            'password2' => 'same:password',
        ], [
            // Mensajes de validaciones
            'nombres.required' => 'El nombre es obligatorio.',
            'nombres.min' => 'El nombre debe tener al menos 3 caracteres.',
            'apellidos.required' => 'Los apellidos son obligatorios.',
            'apellidos.min' => 'Los apellidos deben tener al menos 3 caracteres.',
            'image.file' => 'El archivo seleccionado debe ser un archivo.',
            'image.image' => 'El archivo seleccionado no es una imagen.',
            'image.mimes' => 'El archivo seleccionado debe ser un archivo PNG, JPEG o JPG.',
            'email.email' => 'El email no es válido.',
            'username.required' => 'El nombre de usuario es obligatorio.',
            'username.min' => 'El nombre de usuario debe tener al menos 3 caracteres.',
            'username.unique' => 'El nombre de usuario ya está en uso.',
            'password.required' => 'La contraseña es obligatoria.',
            'password.min' => 'La contraseña debe tener al menos 5 caracteres.',
            'password2.same' => 'Las contraseñas no coinciden.',
        ]);

        $nuevoUsuario = new User();
        // validar si existe image y guardar en storage/app/public/perfil
        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->getClientOriginalExtension();
            $request->image->storeAs('public/perfil', $imageName);
            $nuevoUsuario->imagen = $imageName;
        }

        // guardar los datos del usuario en la base de datos
        $nuevoUsuario->nombres = $request->nombres;
        $nuevoUsuario->apellidos = $request->apellidos;
        $nuevoUsuario->email = $request->email;
        $nuevoUsuario->username = $request->username;
        $nuevoUsuario->password =  bcrypt($request->password);
        $nuevoUsuario->estado = 'ACTIVO';
        $nuevoUsuario->save();

        return redirect()->route('usuario')->with('message', 'Usuario creado correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $usuario = User::where('id', $id)->first();
        return view('backend.usuarios.nuevo', compact('usuario'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nombres' => 'required|min:3',
            'apellidos' => 'required|min:3',
            // validate image for files png, jpeg and jpg
            'image' => 'nullable|file|image|mimes:png,jpeg,jpg',
            'email' => 'nullable|email',
            'username' => 'required|min:3|unique:users,username,' . $id,
            'password' => 'nullable|min:5',
            'password2' => 'same:password',
        ], [
            // Mensajes de validaciones
            'nombres.required' => 'El nombre es obligatorio.',
            'nombres.min' => 'El nombre debe tener al menos 3 caracteres.',
            'apellidos.required' => 'Los apellidos son obligatorios.',
            'apellidos.min' => 'Los apellidos deben tener al menos 3 caracteres.',
            'image.file' => 'El archivo seleccionado debe ser un archivo.',
            'image.image' => 'El archivo seleccionado no es una imagen.',
            'image.mimes' => 'El archivo seleccionado debe ser un archivo PNG, JPEG o JPG.',
            'email.email' => 'El email no es válido.',
            'username.required' => 'El nombre de usuario es obligatorio.',
            'username.min' => 'El nombre de usuario debe tener al menos 3 caracteres.',
            'username.unique' => 'El nombre de usuario ya está en uso.',
            'password.required' => 'La contraseña es obligatoria.',
            'password.min' => 'La contraseña debe tener al menos 5 caracteres.',
            'password2.same' => 'Las contraseñas no coinciden.',
        ]);

        $usuario = User::where('id', $id)->first();
        // validar si existe image y guardar en storage/app/public/perfil
        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->getClientOriginalExtension();
            $request->image->storeAs('public/perfil', $imageName);
            $usuario->imagen = $imageName;
        }

        // guardar los datos del usuario en la base de datos
        $usuario->nombres = $request->nombres;
        $usuario->apellidos = $request->apellidos;
        $usuario->email = $request->email;
        $usuario->username = $request->username;
        if (!empty($request->password)) {
            $usuario->password = bcrypt($request->password);
        }
        $usuario->estado = $request->estado;
        $usuario->save();

        return redirect()->route('usuario')->with('message', 'Usuario actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $usuario = User::where('id', $id)->first();
        $usuario->delete();

        return redirect()->route('usuario')->with('message', 'Usuario eliminado correctamente.');
    }
}
