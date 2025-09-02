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
        Schema::table('historial_info_inscripcions', function (Blueprint $table) {

            $table->foreign('historial_inscripcion_id')
                  ->references('id')
                  ->on('historial_inscripcions')
                  ->onDelete('restrict');

            $table->foreign('cierre_causa_id')
                  ->references('id')
                  ->on('cierre_causas')
                  ->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('historial_info_inscripcions', function (Blueprint $table) {

            $table->dropForeign(['historial_inscripcion_id']);
            $table->dropForeign(['cierre_causa_id']);

            $table->dropIndex('historial_info_inscripcions_historial_inscripcion_id_foreign');
            $table->dropIndex('historial_info_inscripcions_cierre_causa_id_foreign');
        });
    }
};
