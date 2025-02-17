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
        Schema::create('inscripcion_finalizacion', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('id_persona');
            $table->foreign('id_persona')->references('id')->on('persona');
            $table->unsignedInteger('id_inscripcion_historial')->unique();
            $table->foreign('id_inscripcion_historial')->references('id')->on('inscripcion_historial');
            $table->unsignedBigInteger('id_usuario')->nullable()->comment('Usuario que generó el movimiento');
            $table->foreign('id_usuario')->references('id')->on('usuario');
            $table->unsignedbigInteger('id_espacio_academico')->nullable()->comment('Espacio Académico al que pasó');
            $table->foreign('id_espacio_academico')->references('id')->on('espacio_academico');
            $table->date('fecha')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inscripcion_finalizacion');
    }
};
