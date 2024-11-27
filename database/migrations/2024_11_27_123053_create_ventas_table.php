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
        Schema::create('ventas', function (Blueprint $table) {
            $table->id('cod_venta');
            $table->unsignedBigInteger('cod_cliente');
            $table->unsignedBigInteger('cod_producto');
            $table->integer('cantidad');
            $table->float('precio_unitario');
            $table->date('fecha_venta');
            $table->foreign('cod_cliente')->references('cod_cliente')->on('clientes');
            $table->foreign('cod_producto')->references('cod_producto')->on('productos');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ventas');
    }
};
