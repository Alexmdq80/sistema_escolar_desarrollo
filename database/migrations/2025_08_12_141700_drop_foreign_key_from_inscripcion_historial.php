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
        Schema::table('inscripcion_historial', function (Blueprint $table) {
            $table->dropForeign('inscripcion_historial_id_adulto_vinculo_1_foreign');
            $table->dropForeign('inscripcion_historial_id_adulto_vinculo_2_foreign');
            $table->dropForeign('inscripcion_historial_id_adulto_vinculo_3_foreign');
            $table->dropForeign('inscripcion_historial_id_ciclo_lectivo_foreign');
            $table->dropForeign('inscripcion_historial_id_condicion_foreign');
            $table->dropForeign('inscripcion_historial_id_escuela_destino_foreign');
            $table->dropForeign('inscripcion_historial_id_escuela_procedencia_foreign');
            $table->dropForeign('inscripcion_historial_id_espacio_academico_foreign');
            $table->dropForeign('inscripcion_historial_id_modalidad_procedencia_foreign');
            $table->dropForeign('inscripcion_historial_id_nivel_procedencia_foreign');
            $table->dropForeign('inscripcion_historial_id_persona_adulto_1_foreign');
            $table->dropForeign('inscripcion_historial_id_persona_adulto_2_foreign');
            $table->dropForeign('inscripcion_historial_id_persona_adulto_3_foreign');
            $table->dropForeign('inscripcion_historial_id_persona_firma_foreign');
            $table->dropForeign('inscripcion_historial_id_persona_foreign');
        });
        Schema::table('inscripcion_historial', function (Blueprint $table) {
            $table->dropIndex('inscripcion_historial_id_persona_foreign');
            $table->dropIndex('inscripcion_historial_id_persona_firma_foreign');
            $table->dropIndex('inscripcion_historial_id_espacio_academico_foreign');
            $table->dropIndex('inscripcion_historial_id_escuela_procedencia_foreign');
            $table->dropIndex('inscripcion_historial_id_escuela_destino_foreign');
            $table->dropIndex('inscripcion_historial_id_nivel_procedencia_foreign');
            $table->dropIndex('inscripcion_historial_id_modalidad_procedencia_foreign');
            $table->dropIndex('inscripcion_historial_id_condicion_foreign');
         //   $table->dropIndex('inscripcion_historial_id_usuario_index');
            $table->dropIndex('inscripcion_historial_id_usuario_foreign');
            $table->dropIndex('inscripcion_historial_id_ciclo_lectivo_foreign');
            $table->dropIndex('inscripcion_historial_id_persona_adulto_1_foreign');
            $table->dropIndex('inscripcion_historial_id_adulto_vinculo_1_foreign');
            $table->dropIndex('inscripcion_historial_id_persona_adulto_2_foreign');
            $table->dropIndex('inscripcion_historial_id_adulto_vinculo_2_foreign');
            $table->dropIndex('inscripcion_historial_id_persona_adulto_3_foreign');
            $table->dropIndex('inscripcion_historial_id_adulto_vinculo_3_foreign');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('inscripcion_historial', function (Blueprint $table) {
            $table->foreign('id_persona')->references('id')->on('persona');
            $table->foreign('id_persona_firma')->references('id')->on('persona');
            $table->foreign('id_espacio_academico')->references('id')->on('espacio_academico');
            $table->foreign('id_escuela_procedencia')->references('id')->on('escuela');
            $table->foreign('id_escuela_destino')->references('id')->on('escuela');
            $table->foreign('id_nivel_procedencia')->references('id')->on('nivel');
            $table->foreign('id_modalidad_procedencia')->references('id')->on('modalidad');
            $table->foreign('id_condicion')->references('id')->on('condicion');
            $table->index('id_usuario');
            $table->foreign('id_ciclo_lectivo')->references('id')->on('ciclo_lectivo');
            $table->foreign('id_persona_adulto_1')->references('id')->on('persona');
            $table->foreign('id_adulto_vinculo_1')->references('id')->on('adulto_vinculo');
            $table->foreign('id_persona_adulto_2')->references('id')->on('persona');
            $table->foreign('id_adulto_vinculo_2')->references('id')->on('adulto_vinculo');
            $table->foreign('id_persona_adulto_3')->references('id')->on('persona');
            $table->foreign('id_adulto_vinculo_3')->references('id')->on('adulto_vinculo');

        });
    }
};
