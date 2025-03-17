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
            $table->dropForeign('inscripcion_finalizado_id_condicion_finalizacion_foreign');
            $table->renameColumn('id_condicion_finalizacion','id_condicion');
            $table->foreign('id_condicion')->references('id')->on('condicion');
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('inscripcion_finalizado', function (Blueprint $table) {
            //
        });
    }
};
