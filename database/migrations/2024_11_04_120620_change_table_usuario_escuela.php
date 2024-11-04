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
            // CAMBIAR NOMBRE DE ID_USUARIO POR ID_USERS
            if (Schema::hasColumn('usuario_escuela', 'id_usuario')) {
                $table->renameColumn('id_usuario','id_users');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('usuario_escuela', function (Blueprint $table) {
            //
            if (Schema::hasColumn('usuario_escuela', 'id_users')) {
                $table->renameColumn('id_users','id_usuario');
            }
        });
    }
};
