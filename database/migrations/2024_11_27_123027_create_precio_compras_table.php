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
        Schema::create('precio_compras', function (Blueprint $table) {
            $table->id('cod_precio_compra');
            $table->unsignedBigInteger('cod_compra');
            $table->unsignedBigInteger('cod_producto');
            $table->decimal('precio_unitario', 10, 2);
            $table->integer('stock');
            $table->date('fecha_caducidad')->nullable();
            $table->foreign('cod_compra')->references('cod_compra')->on('compras');
            $table->foreign('cod_producto')->references('cod_producto')->on('productos');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('precio_compras');
    }
};
