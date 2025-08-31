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
        Schema::table('propuesta_institucional', function (Blueprint $table) {
            $table->dropForeign('propuesta_institucional_id_anio_foreign');
            $table->dropForeign('propuesta_institucional_id_anio_plan_foreign');
            $table->dropForeign('propuesta_institucional_id_ciclo_lectivo_foreign');
            $table->dropForeign('propuesta_institucional_id_ciclo_plan_estudio_foreign');
            $table->dropForeign('propuesta_institucional_id_jornada_foreign');
            $table->dropForeign('propuesta_institucional_id_plan_estudio_foreign');
            $table->dropForeign('propuesta_institucional_id_turno_fin_foreign');
            $table->dropForeign('propuesta_institucional_id_turno_inicio_foreign');
        });
        Schema::table('propuesta_institucional', function (Blueprint $table) {
            $table->dropIndex('propuesta_institucional_id_anio_foreign');
            $table->dropIndex('propuesta_institucional_id_anio_plan_foreign');
            $table->dropIndex('propuesta_institucional_id_ciclo_lectivo_foreign');
            $table->dropIndex('propuesta_institucional_id_ciclo_plan_estudio_foreign');
            $table->dropIndex('propuesta_institucional_id_jornada_foreign');
            $table->dropIndex('propuesta_institucional_id_plan_estudio_foreign');
            $table->dropIndex('propuesta_institucional_id_turno_fin_foreign');
            $table->dropIndex('propuesta_institucional_id_turno_inicio_foreign');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('propuesta_institucional', function (Blueprint $table) {
            // Las claves hay que agregarlas manualmente
            //$table->foreign('id_anio')->references('id')->on('anio');
            $table->foreign('id_anio_plan')->references('id')->on('anio_plan');
            $table->foreign('id_ciclo_lectivo')->references('id')->on('ciclo_lectivo');
            //$table->foreign('id_ciclo_plan_estudio')->references('id')->on('ciclo_plan_estudio');
            $table->foreign('id_jornada')->references('id')->on('jornada');
            //$table->foreign('id_plan_estudio')->references('id')->on('plan_estudio');
            $table->foreign('id_turno_fin')->references('id')->on('turno');
            $table->foreign('id_turno_inicio')->references('id')->on('turno');
        });
    }
};
