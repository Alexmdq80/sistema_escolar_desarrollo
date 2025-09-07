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
        Schema::table('inscripcion_pases', function (Blueprint $table) {

            $table->foreign('escuela_id')
                  ->references('id')
                  ->on('escuelas')
                  ->onDelete('restrict');

            $table->foreign('historial_inscripcion_id')
                  ->references('id')
                  ->on('historial_inscripcions')
                  ->onDelete('restrict');

            $table->foreign('salida_motivo_id')
                  ->references('id')
                  ->on('salida_motivos')
                  ->onDelete('restrict');

            $table->foreign('escuela_ubicacion_id')
                  ->references('id')
                  ->on('escuela_ubicacions')
                  ->onDelete('restrict');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('inscripcion_pases', function (Blueprint $table) {


            $table->dropForeign(['escuela_id']);
            $table->dropForeign(['historial_inscripcion_id']);
            $table->dropForeign(['salida_motivo_id']);
            $table->dropForeign(['escuela_ubicacion_id']);

            $table->dropIndex('inscripcion_pases_escuela_id_foreign');
            $table->dropIndex('inscripcion_pases_historial_inscripcion_id_foreign');
            $table->dropIndex('inscripcion_pases_salida_motivo_id_foreign');
            $table->dropIndex('inscripcion_pases_escuela_ubicacion_id_foreign');
        });

    }
};
