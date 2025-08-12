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
        Schema::table('inscripcion_baja', function (Blueprint $table) {
            $table->dropForeign('inscripcion_baja_id_inscripcion_historial_foreign');
            $table->dropForeign('inscripcion_baja_id_salida_motivo_foreign');
        });
        Schema::table('inscripcion_baja', function (Blueprint $table) {
            $table->dropUnique('inscripcion_baja_id_inscripcion_historial_unique');
            $table->dropIndex('inscripcion_baja_id_salida_motivo_foreign');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('inscripcion_baja', function (Blueprint $table) {
            $table->unique(['id_inscripcion_historial']);

            $table->foreign('id_inscripcion_historial')->references('id')->on('inscripcion_historial');
            $table->foreign('id_salida_motivo')->references('id')->on('salida_motivo');

        });
    }
};
