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
        Schema::create('propuesta_institucional', function (Blueprint $table) {
            $table->increments('id');
            $table->smallInteger('id_plan_estudio')->unsigned();
            $table->foreign('id_plan_estudio')->references('id')->on('plan_estudio');
            $table->tinyInteger('id_ciclo_plan_estudio')->unsigned();
            $table->foreign('id_ciclo_plan_estudio')->references('id')->on('ciclo_plan_estudio');
            $table->tinyInteger('id_anio')->unsigned();
            $table->foreign('id_anio')->references('id')->on('anio');
            $table->mediumInteger('id_anio_plan')->unsigned();
            $table->foreign('id_anio_plan')->references('id')->on('anio_plan');
            $table->tinyInteger('id_turno_inicio')->unsigned();
            $table->foreign('id_turno_inicio')->references('id')->on('turno');
            $table->tinyInteger('id_turno_fin')->unsigned();
            $table->foreign('id_turno_fin')->references('id')->on('turno');
            $table->tinyInteger('id_jornada')->unsigned();
            $table->foreign('id_jornada')->references('id')->on('jornada');
            $table->tinyInteger('id_ciclo_lectivo')->unsigned();
            $table->foreign('id_ciclo_lectivo')->references('id')->on('ciclo_lectivo');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('propuesta_institucional');
    }
};
