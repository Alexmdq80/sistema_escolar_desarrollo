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
            /*$table->dropForeign('inscripcion_baja_id_usuario_foreign');
            $table->dropColumn('id_usuario');*/
            $table->dropColumn('created_at');
            $table->dropColumn('updated_at');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('inscripcion_baja', function (Blueprint $table) {
            /*$table->unsignedBigInteger('id_usuario')->comment('Usuario que generó el movimiento');
            $table->foreign('id_usuario')->references('id')->on('usuario');*/
            $table->timestamps();
        });
    }
};
