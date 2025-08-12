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
        Schema::table('inscripcion_historial_info', function (Blueprint $table) {
            $table->dropForeign('inscripcion_historial_info_id_inscripcion_cierre_foreign');
            $table->dropForeign('inscripcion_historial_info_id_inscripcion_historial_foreign');
        });
        Schema::table('inscripcion_historial_info', function (Blueprint $table) {
            $table->dropUnique('inscripcion_historial_info_id_inscripcion_historial_unique');

            $table->dropIndex('inscripcion_historial_info_id_inscripcion_cierre_foreign');
          //  $table->dropIndex('inscripcion_historial_info_id_inscripcion_historial_foreign');
            $table->dropIndex('inscripcion_historial_info_id_usuario_index');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('inscripcion_historial_info', function (Blueprint $table) {
//            $table->unique(['id_inscripcion_historial'], 'inscripcion_historial_info_id_inscripcion_historial_foreign');
            $table->unique(['id_inscripcion_historial']);
            $table->Index(['id_usuario']);

            $table->foreign('id_inscripcion_cierre')->references('id')->on('inscripcion_cierre');
            $table->foreign('id_inscripcion_historial')->references('id')->on('inscripcion_historial');
        
        });
    }
};
