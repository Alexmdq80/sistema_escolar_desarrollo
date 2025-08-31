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
        Schema::table('inscripcion', function (Blueprint $table) {
            $table->dropForeign('inscripcion_id_ciclo_lectivo_foreign');
            $table->dropForeign('inscripcion_id_condicion_foreign');
            $table->dropForeign('inscripcion_id_escuela_destino_foreign');
            $table->dropForeign('inscripcion_id_escuela_procedencia_foreign');
            $table->dropForeign('inscripcion_id_espacio_academico_foreign');
            $table->dropForeign('inscripcion_id_modalidad_procedencia_foreign');
            $table->dropForeign('inscripcion_id_nivel_procedencia_foreign');
            $table->dropForeign('inscripcion_id_persona_firma_foreign');
            $table->dropForeign('inscripcion_id_persona_foreign');
            $table->dropForeign('inscripcion_responsable_1_foreign');
            $table->dropForeign('inscripcion_responsable_2_foreign');
            $table->dropForeign('inscripcion_restringida_foreign');
        });
        Schema::table('inscripcion', function (Blueprint $table) {
            $table->dropUnique('inscripcion_id_persona_unique');

            $table->dropIndex('inscripcion_id_espacio_academico_foreign');
            $table->dropIndex('inscripcion_id_escuela_procedencia_foreign');
            $table->dropIndex('inscripcion_id_escuela_destino_foreign');
            $table->dropIndex('inscripcion_id_nivel_procedencia_foreign');
            $table->dropIndex('inscripcion_id_modalidad_procedencia_foreign');
            $table->dropIndex('inscripcion_id_condicion_foreign');
            $table->dropIndex('inscripcion_responsable_1_foreign');
            $table->dropIndex('inscripcion_responsable_2_foreign');
            $table->dropIndex('inscripcion_restringida_foreign');
            $table->dropIndex('inscripcion_id_ciclo_lectivo_foreign');
            $table->dropIndex('inscripcion_id_persona_firma_foreign');
//            $table->dropIndex('inscripcion_id_usuario_index');
            $table->dropIndex('inscripcion_id_usuario_foreign');


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('inscripcion', function (Blueprint $table) {
            $table->unique(['id_persona']);
            // hay que agregar algunas claves manualmente
          //  $table->foreign('id_ciclo_lectivo')->references('id')->on('ciclo_lectivo');
            $table->foreign('id_condicion')->references('id')->on('condicion');
           // $table->foreign('id_escuela_destino')->references('id')->on('escuela');
            $table->foreign('id_escuela_procedencia')->references('id')->on('escuela');
            $table->foreign('id_espacio_academico')->references('id')->on('espacio_academico');
            $table->foreign('id_modalidad_procedencia')->references('id')->on('modalidad');
            $table->foreign('id_nivel_procedencia')->references('id')->on('nivel');
            $table->foreign('id_persona_firma')->references('id')->on('persona');
            $table->foreign('id_persona')->references('id')->on('persona');
            $table->foreign('responsable_1')->references('id')->on('estudiante_adulto_vinculo');
            $table->foreign('responsable_2')->references('id')->on('estudiante_adulto_vinculo');
            $table->foreign('restringida')->references('id')->on('estudiante_adulto_vinculo');

            $table->index('id_usuario');
        });
    }
};
