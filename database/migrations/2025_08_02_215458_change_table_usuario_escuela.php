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
        // Paso 1: Vaciar la tabla completamente.
        // ojo, esto vacía la tabla por completo!!!
        DB::table('usuario_escuela')->truncate();

        DB::statement('ALTER TABLE usuario_escuela MODIFY id MEDIUMINT UNSIGNED;');

        Schema::table('usuario_escuela', function (Blueprint $table) {
            // Paso 1: Eliminar la clave primaria actual.
            // Esto solo es necesario si el 'id' es la clave primaria.
            // Si el 'id' es auto_increment, debes quitar el atributo primero.
            $table->dropPrimary();
        });

        Schema::table('usuario_escuela', function (Blueprint $table) {
            // Paso 2: Renombrar temporalmente la columna 'id' para evitar conflictos.
            // Luego eliminas la columna 'verificado'.
            $table->renameColumn('id', 'temp_id');
            $table->dropColumn('verificado');
        });
        Schema::table('usuario_escuela', function (Blueprint $table) {
            // Paso 3: Añadir el nuevo 'id' (UUID) y las nuevas columnas.
            // El 'id' se definirá como la nueva clave primaria.
            $table->uuid('id')->primary()->first(); // Coloca la nueva columna al principio
            $table->timestamp('verified_at')->nullable()->after('id_usuario');
            $table->timestamps();
        });
        Schema::table('usuario_escuela', function (Blueprint $table) {
            // Paso 4: Eliminar la columna temporal 'temp_id'.
            $table->dropColumn('temp_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('usuario_escuela', function (Blueprint $table) {
            throw new \RuntimeException('Cannot revert this migration without data loss.');
        });
    }
};
