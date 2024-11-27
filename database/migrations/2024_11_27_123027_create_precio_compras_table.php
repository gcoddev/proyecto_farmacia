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
            $table->float('precio_unitario');
            $table->foreign('cod_compra')->references('cod_compra')->on('compras');
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
