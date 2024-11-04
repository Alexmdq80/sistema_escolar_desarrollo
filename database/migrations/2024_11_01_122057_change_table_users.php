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
        Schema::table('users', function (Blueprint $table) {
            // MODIFICO LA TABLA USERS, PARA LUEGO
            // PODER USAR LOS MISMOS USUARIOS
            // EN AMBOS SISTEMAS (EXCEL Y WEB), MISMO USUARIO
            // , DISTINTA CONTRASEÑA
            $table->renameColumn('name','nombre');
            $table->string('nombre_usuario', 25)->unique();
            $table->string('apellido');
            $table->string('clave')->comment('CONTRASEÑA PARA SISTEMA VBA.');
            $table->string('password')->comment('CONTRASEÑA PARA SISTEMA WEB.')->change();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // REVERTIR CAMBIOS
            $table->renameColumn('nombre','name');
            $table->dropUnique('users_nombre_usuario_unique');
            $table->dropColumn('nombre_usuario');
            $table->dropColumn('apellido');
            $table->dropColumn('clave');
            $table->string('password')->comment('')->change();

        });
    }
};
