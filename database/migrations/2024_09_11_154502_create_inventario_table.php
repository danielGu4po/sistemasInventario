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
        Schema::create('inventario', function (Blueprint $table) {
            $table->id();
            $table->text('inventarioMarca');
            $table->text('inventarioModelo');
            $table->string('inventarioSerie');
            $table->string('inventarioRAM')->nullable();
            $table->string('inventarioAlmacenamiento')->nullable(); // Hacer que el campo sea opcional
            $table->text('inventarioContraseña')->nullable();
            $table->string('inventarioEstado');
            $table->string('inventarioNumTel')->nullable();
            $table->string('inventarioLineaTel')->nullable();
            $table->text('inventarioObservaciones')->nullable();
            $table->boolean('inventarioAsignado')->default(false);
            $table->string('inventarioCategoria')->nullable();
            $table->timestamps();
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventario');
    }
};
