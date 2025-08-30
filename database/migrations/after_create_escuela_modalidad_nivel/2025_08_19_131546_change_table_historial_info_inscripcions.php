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
            $table->softDeletes();

            $table->dropColumn('id_usuario');
           
            $table->tinyInteger('id_inscripcion_cierre')->unsigned()->after('id_inscripcion_historial')->change();

            $table->renameColumn('id_inscripcion_historial', 'historial_inscripcion_id');
            $table->renameColumn('id_inscripcion_cierre', 'cierre_causa_id');

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
            $table->dropSoftDeletes();

            $table->dropForeign(['historial_inscripcion_id']);
            $table->dropForeign(['cierre_causa_id']);

            $table->dropIndex('historial_info_inscripcions_historial_inscripcion_id_foreign');
            $table->dropIndex('historial_info_inscripcions_cierre_causa_id_foreign');

            $table->unsignedBigInteger('id_usuario')->comment('Usuario que realizó el movimiento');
          
            $table->renameColumn('historial_inscripcion_id', 'id_inscripcion_historial');
            $table->renameColumn('cierre_causa_id', 'id_inscripcion_cierre');

        });
    }
};
