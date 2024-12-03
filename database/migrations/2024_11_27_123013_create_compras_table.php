<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('compras', function (Blueprint $table) {
            $table->id('cod_compra');
            $table->unsignedBigInteger('cod_proveedor');
            $table->unsignedBigInteger('cod_usuario');
            $table->unsignedBigInteger('cod_producto');
            $table->integer('cantidad');
            $table->date('fecha_compra');
            $table->decimal('monto_total', 10, 2);
            $table->foreign('cod_proveedor')->references('cod_proveedor')->on('proveedores');
            $table->foreign('cod_usuario')->references('cod_usuario')->on('usuarios');
            $table->foreign('cod_producto')->references('cod_producto')->on('productos');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('compras');
    }
};
