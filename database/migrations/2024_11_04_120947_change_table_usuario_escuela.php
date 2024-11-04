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
            // RENOMBRA EL ÍNDICE
            $table->renameIndex('usuario_escuela_id_usuario_foreign','usuario_escuela_id_users_foreign');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('usuario_escuela', function (Blueprint $table) {
            //
            $table->renameIndex('usuario_escuela_id_users_foreign','usuario_escuela_id_usuario_foreign');
        });
    }
};
