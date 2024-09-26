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
        Schema::create('verificacion', function (Blueprint $table) {

            $table->id();
            $table->string('verificacionCodigo')->nullable();
            $table->string('verificacionModelo')->nullable();
            $table->string('verificacionNumEmpleado')->nullable();
            $table->string('verificacionSerie')->nullable();
            $table->string('verificacionNomUsuario')->nullable();
            $table->string('verificacionAreaDepartamento')->nullable();
            $table->string('verificacionMarca')->nullable();
            $table->string('verificacionAsignacion')->nullable();
            $table->date('verificacionFecha')->nullable();
            $table->boolean('verificacionConcepto1')->default(false);
            $table->boolean('verificacionConcepto2')->default(false);
            $table->boolean('verificacionConcepto3')->default(false);
            $table->boolean('verificacionConcepto4')->default(false);
            $table->boolean('verificacionConcepto5')->default(false);
            $table->boolean('verificacionConcepto6')->default(false);
            $table->boolean('verificacionConcepto7')->default(false);
            $table->boolean('verificacionConcepto8')->default(false);
            $table->boolean('verificacionConcepto9')->default(false);
            $table->boolean('verificacionConcepto10')->default(false);
            $table->boolean('verificacionConcepto11')->default(false);
            $table->boolean('verificacionConcepto12')->default(false);
            $table->boolean('verificacionConcepto13')->default(false);
            $table->boolean('verificacionConcepto14')->default(false);
            $table->boolean('verificacionConcepto15')->default(false);
            $table->boolean('verificacionConcepto16')->default(false);
            $table->boolean('verificacionConcepto17')->default(false);
            $table->boolean('verificacionConcepto18')->default(false);
            $table->boolean('verificacionConcepto19')->default(false);
            $table->boolean('verificacionConcepto20')->default(false);
            $table->boolean('verificacionConcepto21')->default(false);
            $table->boolean('verificacionConcepto22')->default(false);
            $table->boolean('verificacionConcepto23')->default(false);
            $table->boolean('verificacionConcepto24')->default(false);
            $table->boolean('verificacionConcepto25')->default(false);
            $table->boolean('verificacionConcepto26')->default(false);
            $table->boolean('verificacionConcepto27')->default(false);
            $table->boolean('verificacionConcepto28')->default(false);
            $table->boolean('verificacionConcepto29')->default(false);
            $table->boolean('verificacionConcepto30')->default(false);
            $table->boolean('verificacionConcepto31')->default(false);
            $table->boolean('verificacionConcepto32')->default(false);
            $table->boolean('verificacionConcepto33')->default(false);
            $table->boolean('verificacionConcepto34')->default(false);
            $table->boolean('verificacionConcepto35')->default(false);
            $table->boolean('verificacionConcepto36')->default(false);
            $table->boolean('verificacionConcepto37')->default(false);
            $table->boolean('verificacionConcepto38')->default(false);
            $table->boolean('verificacionConcepto39')->default(false);
            $table->boolean('verificacionConcepto40')->default(false);
            $table->boolean('verificacionConcepto41')->default(false);
            $table->boolean('verificacionConcepto42')->default(false);
            $table->boolean('verificacionConcepto43')->default(false);
            $table->boolean('verificacionConcepto44')->default(false);
            $table->boolean('verificacionConcepto45')->default(false);
            $table->boolean('verificacionConcepto46')->default(false);
            $table->boolean('verificacionConcepto47')->default(false);
            $table->boolean('verificacionConcepto48')->default(false);
            $table->text('verificacionConcepto')->nullable();
            $table->text('verificacionAccion')->nullable();
            $table->text('verificacionResponsable')->nullable();
            $table->date('verificacionFechaCumplimiento')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('verificacion');
    }
};
