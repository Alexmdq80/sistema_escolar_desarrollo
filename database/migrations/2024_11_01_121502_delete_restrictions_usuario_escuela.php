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
            // ELIMINO LA RELACIÓN CON USUARIO
            // $table->dropForeign('usuario_escuela_id_usuario_foreign');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('usuario_escuela', function (Blueprint $table) {
            // VUELVO A CREAR LA RESTRICCION
            // $table->foreign('id_usuario')->references('id')->on('usuario');
        });
    }
};
