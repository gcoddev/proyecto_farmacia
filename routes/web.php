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
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\EstadisticaController;
use App\Http\Controllers\VentasController;
use App\Http\Controllers\ComprasController;
use App\Http\Controllers\ReporteController;

// Rutas /admin
Route::prefix('admin')->middleware('usuario_autenticado')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('admin');

    Route::prefix('usuario')->group(function () {
        Route::get('/', [UsuariosController::class, 'index'])->name('usuario');
        Route::get('/nuevo', [UsuariosController::class, 'create'])->name('usuario.nuevo');
        Route::post('/nuevo', [UsuariosController::class, 'store'])->name('usuario.guardar');
        Route::get('/{cod_usuario}/editar', [UsuariosController::class, 'edit'])->name('usuario.editar');
        Route::put('/{cod_usuario}/editar', [UsuariosController::class, 'update'])->name('usuario.actualizar');
        Route::delete('/{cod_usuario}', [UsuariosController::class, 'destroy'])->name('usuario.eliminar');
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

    Route::prefix('categoria')->group(function () {
        Route::get('/', [CategoriaController::class, 'index'])->name('categoria');
        Route::get('/nuevo', [CategoriaController::class, 'create'])->name('categoria.nuevo');
        Route::post('/nuevo', [CategoriaController::class, 'store'])->name('categoria.guardar');
        Route::get('/{id}/editar', [CategoriaController::class, 'edit'])->name('categoria.editar');
        Route::put('/{id}/editar', [CategoriaController::class, 'update'])->name('categoria.actualizar');
        Route::delete('/{id}', [CategoriaController::class, 'destroy'])->name('categoria.eliminar');
    });

    Route::prefix('producto')->group(function () {
        Route::get('/', [ProductoController::class, 'index'])->name('producto');
        Route::get('/nuevo', [ProductoController::class, 'create'])->name('producto.nuevo');
        Route::post('/nuevo', [ProductoController::class, 'store'])->name('producto.guardar');
        Route::get('/{id}/editar', [ProductoController::class, 'edit'])->name('producto.editar');
        Route::put('/{id}/editar', [ProductoController::class, 'update'])->name('producto.actualizar');
        Route::delete('/{id}', [ProductoController::class, 'destroy'])->name('producto.eliminar');
    });

    Route::prefix('venta')->group(function () {
        Route::get('/', [VentasController::class, 'index'])->name('venta');
        Route::get('/nuevo', [VentasController::class, 'create'])->name('venta.nuevo');
        Route::post('/nuevo', [VentasController::class, 'store'])->name('venta.guardar');
        Route::get('/{id}/editar', [VentasController::class, 'edit'])->name('venta.editar');
        Route::put('/{id}/editar', [VentasController::class, 'update'])->name('venta.actualizar');
        Route::delete('/{id}', [VentasController::class, 'destroy'])->name('venta.eliminar');

        Route::get('/cliente', [VentasController::class, 'buscar'])->name('venta.cliente');
    });

    Route::prefix('compra')->group(function () {
        Route::get('/', [ComprasController::class, 'index'])->name('compra');
        Route::get('/nuevo', [ComprasController::class, 'create'])->name('compra.nuevo');
        Route::post('/nuevo', [ComprasController::class, 'store'])->name('compra.guardar');
        Route::get('/{id}/editar', [ComprasController::class, 'edit'])->name('compra.editar');
        Route::put('/{id}/editar', [ComprasController::class, 'update'])->name('compra.actualizar');
        Route::delete('/{id}', [ComprasController::class, 'destroy'])->name('compra.eliminar');

        Route::get('/cliente', [ComprasController::class, 'buscar'])->name('compra.cliente');
    });



    Route::prefix('estadistica')->group(function () {
        Route::get('compras', [EstadisticaController::class, 'compras'])->name('estadistica.compras');
        Route::get('ventas', [EstadisticaController::class, 'ventas'])->name('estadistica.ventas');
    });

    Route::prefix('pdf')->group(function () {
        Route::get('compras', [ReporteController::class, 'compras'])->name('pdf.compras');
        Route::get('ventas', [ReporteController::class, 'ventas'])->name('pdf.ventas');
    });
});

// Inicio
Route::get('/', [InicioController::class, 'index'])->name('inicio');

// Rutas de sesión
Route::get('/login', [LoginController::class, 'index'])->middleware('usuario_no_autenticado')->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('post_login');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
