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
            // AGREGO RESTRICCIÓN PARA USUARIO_ESCUELA -> ID_USUARIO
            // if (!$table->hasIndex('usuario_escuela_id_usuario_foreign')) {
            if (!collect(DB::select("SHOW INDEXES FROM usuario_escuela"))->pluck('Key_name')->contains('usuario_escuela_id_usuario_foreign')) {
                $table->foreign('id_usuario')->references('id')->on('usuario');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('usuario_escuela', function (Blueprint $table) {
            if (collect(DB::select("SHOW INDEXES FROM usuario_escuela"))->pluck('Key_name')->contains('usuario_escuela_id_usuario_foreign')) {
                $table->dropForeign('usuario_escuela_id_usuario_foreign');
            }
        });
    }
};
