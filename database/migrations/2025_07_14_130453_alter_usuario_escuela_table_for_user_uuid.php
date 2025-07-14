<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('usuario_escuela', function (Blueprint $table) {
           // 1. Eliminar la clave foránea existente
           // $table->dropForeign(['id_usuario']);
            // 2. Cambiar el tipo de la columna a UUID (y hacerla nullable temporalmente si hay datos nulos)
            $table->uuid('id_usuario')->change(); // Asegúrate de que sea nullable o no, según tu lógica
        });
        // 3. Actualizar los user_id existentes con los nuevos UUIDs
        // Esto es CRÍTICO si tienes datos existentes
        DB::statement('
            UPDATE usuario_escuela u_e
            JOIN usuario u ON u_e.id_usuario = CAST(u.id AS CHAR(36))
            SET u_e.id_usuario = u.uuid;
        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('usuario_escuela', function (Blueprint $table) {
            $table->unsignedBigInteger('id_usuario')->change();
        });
    }
};
