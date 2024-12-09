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
        Schema::create('inscripcion_historial', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('id_persona');
            $table->foreign('id_persona')->references('id')->on('persona');
            $table->unsignedInteger('id_persona_firma')->nullable()->comment('ID persona');
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
            $table->string('codigo_abc', 6)->nullable();
            $table->unsignedBigInteger('id_usuario')->nullable()->comment('Usuario que realizó la inscripción');
            $table->foreign('id_usuario')->references('id')->on('usuario');
            $table->unsignedInteger('id_responsable_1')->nullable()->comment('ID persona');
            $table->foreign('id_responsable_1')->references('id')->on('persona');
            $table->unsignedInteger('id_responsable_2')->nullable()->comment('ID persona');
            $table->foreign('id_responsable_2')->references('id')->on('persona');
            $table->unsignedInteger('id_restringida')->nullable()->comment('ID persona');
            $table->foreign('id_restringida')->references('id')->on('persona');
            $table->unsignedTinyInteger('id_ciclo_lectivo');
            $table->foreign('id_ciclo_lectivo')->references('id')->on('ciclo_lectivo');
            $table->unsignedTinyInteger('id_inscripcion_cierre');
            $table->foreign('id_inscripcion_cierre')->references('id')->on('inscripcion_cierre');
            $table->unsignedTinyInteger('id_adulto_vinculo_resp_1')->nullable();
            $table->foreign('id_adulto_vinculo_resp_1')->references('id')->on('adulto_vinculo');
            $table->unsignedTinyInteger('id_adulto_vinculo_resp_2')->nullable();
            $table->foreign('id_adulto_vinculo_resp_2')->references('id')->on('adulto_vinculo');
            $table->unsignedTinyInteger('id_adulto_vinculo_rest')->nullable();
            $table->foreign('id_adulto_vinculo_rest')->references('id')->on('adulto_vinculo');
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
        Schema::dropIfExists('inscripcion_historial');
    }
};
