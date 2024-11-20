<?php

// Rutas de la plantilla
require __DIR__ . '/template.php';

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UsuariosController;

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
});

// Rutas de sesión
Route::get('/login', [LoginController::class, 'index'])->middleware('usuario_no_autenticado')->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('post_login');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
