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
            $table->unsignedBigInteger('codigo');
            $table->unsignedBigInteger('cod_cliente')->nullable();
            $table->unsignedBigInteger('cod_producto');
            $table->integer('cantidad');
            $table->decimal('precio_unitario', 10, 2);
            $table->decimal('precio_total', 10, 2);
            $table->date('fecha_venta');
            $table->foreign('cod_cliente')->references('cod_cliente')->on('clientes');
            $table->foreign('cod_producto')->references('cod_producto')->on('productos');
            $table->timestamps();
            $table->softDeletesDatetime();
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
