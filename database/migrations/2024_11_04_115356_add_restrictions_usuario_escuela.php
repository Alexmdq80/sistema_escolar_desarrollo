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
        Schema::table('usuario_escuela', function (Blueprint $table) {
            // AGREGO RESTRICCIÓN PARA USUARIO_ESCUELA -> ID_USUARIO_TIPO
            $table->foreign('id_usuario_tipo')->references('id')->on('usuario_tipo');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('usuario_escuela', function (Blueprint $table) {
            // REVERTIR
            $table->dropForeign('usuario_escuela_id_usuario_tipo_foreign');
        });
    }
};
