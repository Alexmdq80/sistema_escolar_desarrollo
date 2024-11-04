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
        Schema::table('inscripcion', function (Blueprint $table) {
            // CAMBIAR NOMBRE DE ID_USUARIO POR ID_USERS
            if (Schema::hasColumn('inscripcion', 'id_usuario')) {
                $table->renameColumn('id_usuario','id_users');
            }
            $table->renameIndex('inscripcion_id_usuario_foreign','inscripcion_id_users_foreign');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('inscripcion', function (Blueprint $table) {
            //
            if (Schema::hasColumn('inscripcion', 'id_users')) {
                $table->renameColumn('id_users','id_usuario');
            }
            $table->renameIndex('inscripcion_id_users_foreign','inscripcion_id_usuario_foreign');

        });
    }
};
