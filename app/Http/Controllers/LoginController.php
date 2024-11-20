<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('backend.auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ], [
            'username.required' => 'El nombre de usuario es requerido',
            'password.required' => 'La contraseña es requerida'
        ]);

        if (
            Auth::attempt(['username' => $request->username, 'password' => $request->password, 'remember_token' => $request->remember]) ||
            Auth::attempt(['email' => $request->username, 'password' => $request->password, 'remember_token' => $request->remember])
        ) {
            if (Auth::user()->estado == 'INACTIVO') {
                Auth::logout();
                return redirect()->back()->withErrors(['error' => 'Su cuenta se encuentra inactiva']);
            }
            return redirect()->route('admin');
        }

        return redirect()->back()->withErrors(['error' => 'Credenciales incorrectas']);
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login')->with('message', 'Sesión cerrada con éxito');
    }
}
