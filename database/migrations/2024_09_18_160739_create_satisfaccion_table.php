<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('satisfaccion', function (Blueprint $table) {
            $table->id();
            $table->string('numUsuario');
            $table->string('nombrePrestador');
            $table->date('fechaEvaluacion');
            $table->string('evaluador');
            $table->string('periodo');
            $table->integer('numEvaluacion');
            $table->string('categoriaServicio');
            $table->string('categoriaEvaluador');
            $table->boolean('check1')->default(false);
            $table->boolean('check2')->default(false);
            $table->boolean('check3')->default(false);
            $table->boolean('check4')->default(false);
            $table->boolean('check5')->default(false);
            $table->boolean('check6')->default(false);
            $table->text('accionesMejora1')->nullable();
            $table->text('accionesMejora2')->nullable();
            $table->text('accionesMejora3')->nullable();
            $table->text('accionesMejora4')->nullable();
            $table->text('accionesMejora5')->nullable();
            $table->text('accionesMejora6')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('satisfaccion');
    }
};
