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
        Schema::table('users_escuela', function (Blueprint $table) {
            // RENOMBRA EL ÍNDICE
            $table->renameIndex('usuario_escuela_id_escuela_foreign','users_escuela_id_escuela_foreign');
            $table->renameIndex('usuario_escuela_id_usuario_tipo_foreign','users_escuela_id_usuario_tipo_foreign');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users_escuela', function (Blueprint $table) {
            //
            $table->renameIndex('users_escuela_id_escuela_foreign','usuario_escuela_id_escuela_foreign');
            $table->renameIndex('users_escuela_id_usuario_tipo_foreign','usuario_escuela_id_usuario_tipo_foreign');
        });
    }
};
