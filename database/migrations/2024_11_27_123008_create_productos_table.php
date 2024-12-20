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
        Schema::create('productos', function (Blueprint $table) {
            $table->id('cod_producto');
            $table->string('nombre_prod');
            $table->string('presentacion');
            $table->string('cantidad');
            $table->decimal('precio', 10, 2);
            $table->decimal('precio_caja', 10, 2);
            // $table->integer('stock');
            // $table->date('fecha_caducidad');
            $table->unsignedBigInteger('cod_categoria');
            $table->foreign('cod_categoria')->references('cod_categoria')->on('categorias');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('productos');
    }
};
