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
            $table->unsignedTinyInteger('id_inscripcion_cierre');
            $table->foreign('id_inscripcion_cierre')->references('id')->on('inscripcion_cierre');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('inscripcion_historial_info', function (Blueprint $table) {
            $table->dropForeign('inscripcion_historial_info_id_inscripcion_cierre_foreign');
            $table->dropColumn('id_inscripcion_cierre');
        });
    }
};
