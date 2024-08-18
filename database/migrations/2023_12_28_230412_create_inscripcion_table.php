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
        Schema::create('inscripcion', function (Blueprint $table) {
            $table->smallIncrements('id');
            $table->unsignedInteger('id_persona')->unique();
            $table->foreign('id_persona')->references('id')->on('persona');
            $table->unsignedInteger('id_persona_firma')->nullable()->comment('Responsable que firma la inscripción');
            $table->foreign('id_persona_firma')->references('id')->on('persona');
            $table->unsignedbigInteger('id_espacio_academico')->nullable();
            $table->foreign('id_espacio_academico')->references('id')->on('espacio_academico');
            $table->unsignedMediumInteger('id_escuela_procedencia')->nullable();
            $table->foreign('id_escuela_procedencia')->references('id')->on('escuela');
            $table->unsignedMediumInteger('id_escuela_destino');
            $table->foreign('id_escuela_destino')->references('id')->on('escuela');
            $table->unsignedTinyInteger('id_nivel_procedencia')->nullable();
            $table->foreign('id_nivel_procedencia')->references('id')->on('nivel');
            $table->unsignedTinyInteger('id_modalidad_procedencia')->nullable();
            $table->foreign('id_modalidad_procedencia')->references('id')->on('modalidad');
            $table->unsignedTinyInteger('id_condicion')->nullable();
            $table->foreign('id_condicion')->references('id')->on('condicion');
            $table->string('codigo_abc', 10)->nullable();
            $table->unsignedInteger('id_usuario')->nullable()->comment('Usuario que realizó la inscripción');
            $table->foreign('id_usuario')->references('id')->on('usuario');
            $table->unsignedInteger('responsable_1')->nullable()->comment('Primer adulto responsable que figura en la inscripción.');
            $table->foreign('responsable_1')->references('id')->on('persona');
            $table->unsignedInteger('responsable_2')->nullable()->comment('Segundo adulto responsable que figura en la inscripción.');
            $table->foreign('responsable_2')->references('id')->on('persona');
            $table->unsignedInteger('restringida')->nullable()->comment('Adulto con restricción hacia el estudiante.');
            $table->foreign('restringida')->references('id')->on('persona');
            $table->unsignedTinyInteger('id_ciclo_lectivo');
            $table->foreign('id_ciclo_lectivo')->references('id')->on('ciclo_lectivo');
            $table->boolean('proyecto_inclusion_si')->nullable();
            $table->boolean('concurre_especial_si')->nullable();
            $table->boolean('asistente_externo_si')->nullable();
            $table->date('fecha')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inscripcion');
    }
};
