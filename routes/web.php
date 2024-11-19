<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UsuariosController;

// Rutas /admin
Route::prefix('admin')->middleware('usuario_autenticado')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('admin.dashboard');

    Route::prefix('usuario')->group(function () {
        Route::get('/', [UsuariosController::class, 'index'])->name('admin.usuario');
        Route::get('/create', [UsuariosController::class, 'create'])->name('admin.usuario.nuevo');
        Route::get('/{id}/edit', [UsuariosController::class, 'edit'])->name('admin.usuario.editar');
    });
});

Route::get('/login', [LoginController::class, 'index'])->middleware('usuario_no_autenticado')->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('post_login');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

require __DIR__ . '/template.php';
