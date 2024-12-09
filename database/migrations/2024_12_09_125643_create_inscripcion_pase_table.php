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
        Schema::create('inscripcion_pase', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedMediumInteger('id_escuela')->nullable();
            $table->foreign('id_escuela')->references('id')->on('escuela');
            $table->unsignedInteger('id_inscripcion_historial');
            $table->foreign('id_inscripcion_historial')->references('id')->on('inscripcion_historial');
            $table->unsignedTinyInteger('id_pase_motivo');
            $table->foreign('id_pase_motivo')->references('id')->on('pase_motivo');
            $table->unsignedTinyInteger('id_ubicacion_escuela');
            $table->foreign('id_ubicacion_escuela')->references('id')->on('ubicacion_escuela');
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inscripcion_pase');
    }
};
