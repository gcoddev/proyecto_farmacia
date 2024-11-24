<?php

// Rutas de la plantilla
require __DIR__ . '/template.php';

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InicioController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UsuariosController;
use App\Http\Controllers\ClientesController;
use App\Http\Controllers\ProveedoresController;

// Rutas /admin
Route::prefix('admin')->middleware('usuario_autenticado')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('admin');

    Route::prefix('usuario')->group(function () {
        Route::get('/', [UsuariosController::class, 'index'])->name('usuario');
        Route::get('/nuevo', [UsuariosController::class, 'create'])->name('usuario.nuevo');
        Route::post('/nuevo', [UsuariosController::class, 'store'])->name('usuario.guardar');
        Route::get('/{id}/editar', [UsuariosController::class, 'edit'])->name('usuario.editar');
        Route::put('/{id}/editar', [UsuariosController::class, 'update'])->name('usuario.actualizar');
        Route::delete('/{id}', [UsuariosController::class, 'destroy'])->name('usuario.eliminar');
    });

    Route::prefix('cliente')->group(function () {
        Route::get('/', [ClientesController::class, 'index'])->name('cliente');
        Route::get('/nuevo', [ClientesController::class, 'create'])->name('cliente.nuevo');
        Route::post('/nuevo', [ClientesController::class, 'store'])->name('cliente.guardar');
        Route::get('/{id}/editar', [ClientesController::class, 'edit'])->name('cliente.editar');
        Route::put('/{id}/editar', [ClientesController::class, 'update'])->name('cliente.actualizar');
        Route::delete('/{id}', [ClientesController::class, 'destroy'])->name('cliente.eliminar');
    });

    Route::prefix('proveedor')->group(function () {
        Route::get('/', [ProveedoresController::class, 'index'])->name('proveedor');
        Route::get('/nuevo', [ProveedoresController::class, 'create'])->name('proveedor.nuevo');
        Route::post('/nuevo', [ProveedoresController::class, 'store'])->name('proveedor.guardar');
        Route::get('/{id}/editar', [ProveedoresController::class, 'edit'])->name('proveedor.editar');
        Route::put('/{id}/editar', [ProveedoresController::class, 'update'])->name('proveedor.actualizar');
        Route::delete('/{id}', [ProveedoresController::class, 'destroy'])->name('proveedor.eliminar');
    });
});

// Inicio
Route::get('/', [InicioController::class, 'index'])->name('inicio');

// Rutas de sesión
Route::get('/login', [LoginController::class, 'index'])->middleware('usuario_no_autenticado')->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('post_login');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
