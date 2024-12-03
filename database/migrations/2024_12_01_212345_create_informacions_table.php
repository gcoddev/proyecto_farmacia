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
        Schema::create('informacion', function (Blueprint $table) {
            $table->id('cod_info');
            $table->string('nombre');
            $table->string('logo')->nullable();
            $table->string('descripcion')->nullable();
            $table->text('historia')->nullable();
            $table->string('titular')->nullable();
            $table->string('nit')->nullable();
            $table->string('contacto1')->nullable();
            $table->string('contacto2')->nullable();
            $table->string('contacto3')->nullable();
            $table->string('atencion')->nullable();
            $table->string('correo')->nullable();
            $table->string('ubicacion')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('informacion');
    }
};
