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
        Schema::create('mantenimientos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('item_id');
            $table->date('mantenimientoFecha');
            $table->text('mantenimientoDetalles')->nullable();
            $table->string('mantenimientoMtto')->nullable();
            $table->timestamps();

            $table->foreign('item_id')->references('id')->on('inventario')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mantenimientos');
    }
};
