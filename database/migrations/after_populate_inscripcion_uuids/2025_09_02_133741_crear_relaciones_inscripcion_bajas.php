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
        Schema::table('inscripcion_bajas', function (Blueprint $table) {
            $table->foreign('historial_inscripcion_id')
                  ->references('id')
                  ->on('historial_inscripcions')
                  ->onDelete('restrict');

            $table->foreign('salida_motivo_id')
                  ->references('id')
                  ->on('salida_motivos')
                  ->onDelete('restrict');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('inscripcion_bajas', function (Blueprint $table) {
            $table->dropForeign(['historial_inscripcion_id']);
            $table->dropForeign(['salida_motivo_id']);

            $table->dropIndex('inscripcion_bajas_historial_inscripcion_id_foreign');
            $table->dropIndex('inscripcion_bajas_salida_motivo_id_foreign');

        });

    }
};
