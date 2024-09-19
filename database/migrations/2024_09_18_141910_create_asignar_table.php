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
        Schema::create('asignar', function (Blueprint $table) {
            $table->id();
            $table->string('asignarUsuario');
            $table->integer('asignarNoEmpleado');
            $table->string('asignarPuesto');
            $table->string('asignarDepartamento');
            $table->string('asignarEquipoNombre');
            $table->string('asignarUsuarioNombre');
            $table->text('asignarEquipoCorreo');
            $table->unsignedBigInteger('id_inventario');
            $table->foreign('id_inventario')->references('id')->on('inventario');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('asignar');
    }
};
