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
        // renombrar tablas relacionadas a usuarios
        Schema::rename('usuario', 'usuarios');
        Schema::rename('usuario_tipo', 'usuario_tipos');

        Schema::rename('usuario_escuela', 'escuela_usuario');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::rename('usuarios', 'usuario');
        Schema::rename('usuario_tipos', 'usuario_tipo');
        
        Schema::rename('escuela_usuario', 'usuario_escuela');
        
    }
};
