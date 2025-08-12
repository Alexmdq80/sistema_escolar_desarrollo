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
        Schema::table('inscripcion_finalizado', function (Blueprint $table) {
            $table->dropForeign('inscripcion_finalizado_id_condicion_foreign');
            $table->dropForeign('inscripcion_finalizado_id_inscripcion_historial_foreign');
        });
        Schema::table('inscripcion_finalizado', function (Blueprint $table) {
            $table->dropUnique('inscripcion_finalizado_id_inscripcion_historial_unique');            
            $table->dropIndex('inscripcion_finalizado_id_condicion_foreign');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('inscripcion_finalizado', function (Blueprint $table) {
            $table->unique(['id_inscripcion_historial']);

            $table->foreign('id_inscripcion_historial')->references('id')->on('inscripcion_historial');
            $table->foreign('id_condicion')->references('id')->on('condicion');
        });
    }
};
