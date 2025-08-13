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
        Schema::table('inscripcion_pase', function (Blueprint $table) {
            $table->dropForeign('inscripcion_pase_id_departamento_escuela_foreign');
            $table->dropForeign('inscripcion_pase_id_escuela_foreign');
            $table->dropForeign('inscripcion_pase_id_inscripcion_historial_foreign');
            $table->dropForeign('inscripcion_pase_id_pais_escuela_foreign');
            $table->dropForeign('inscripcion_pase_id_provincia_escuela_foreign');
            $table->dropForeign('inscripcion_pase_id_region_educativa_foreign');
            $table->dropForeign('inscripcion_pase_id_salida_motivo_foreign');
            $table->dropForeign('inscripcion_pase_id_sector_foreign');
            $table->dropForeign('inscripcion_pase_id_tipo_escuela_foreign');
            $table->dropForeign('inscripcion_pase_id_ubicacion_escuela_foreign');
        });
        Schema::table('inscripcion_pase', function (Blueprint $table) {
           $table->dropUnique('inscripcion_pase_id_inscripcion_historial_unique');

            $table->dropIndex('inscripcion_pase_id_departamento_escuela_foreign');
            $table->dropIndex('inscripcion_pase_id_escuela_foreign');
            //$table->dropIndex('inscripcion_pase_id_inscripcion_historial_foreign');
            $table->dropIndex('inscripcion_pase_id_pais_escuela_foreign');
            $table->dropIndex('inscripcion_pase_id_provincia_escuela_foreign');
            $table->dropIndex('inscripcion_pase_id_region_educativa_foreign');
            $table->dropIndex('inscripcion_pase_id_salida_motivo_foreign');
            $table->dropIndex('inscripcion_pase_id_sector_foreign');
            $table->dropIndex('inscripcion_pase_id_tipo_escuela_foreign');
            $table->dropIndex('inscripcion_pase_id_ubicacion_escuela_foreign');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('inscripcion_pase', function (Blueprint $table) {
            $table->unique(['id_inscripcion_historial']);

            $table->foreign('id_departamento_escuela')->references('id')->on('departamento');
            $table->foreign('id_escuela')->references('id')->on('escuela');
            $table->foreign('id_inscripcion_historial')->references('id')->on('inscripcion_historial');
            $table->foreign('id_pais_escuela')->references('id')->on('pais');
            $table->foreign('id_provincia_escuela')->references('id')->on('provincia');
            $table->foreign('id_region_educativa')->references('id')->on('region_educativa');
            $table->foreign('id_salida_motivo')->references('id')->on('salida_motivo');
            $table->foreign('id_sector')->references('id')->on('sector');
            $table->foreign('id_tipo_escuela')->references('id')->on('tipo_escuela');
            $table->foreign('id_ubicacion_escuela')->references('id')->on('ubicacion_escuela');

        });
    }
};
