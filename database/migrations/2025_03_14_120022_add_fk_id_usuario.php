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
            $table->unsignedBigInteger('id_usuario')->comment('Usuario que realizó el movimiento');
            $table->foreign('id_usuario')->references('id')->on('usuario');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('inscripcion_historial_info', function (Blueprint $table) {
            $table->dropForeign('inscripcion_historial_info_id_usuario_foreign');
            $table->dropColumn('id_usuario');
        });
    }
};
