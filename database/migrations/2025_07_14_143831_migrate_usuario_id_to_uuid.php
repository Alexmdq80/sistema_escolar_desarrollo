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
        Schema::table('usuario', function (Blueprint $table) {
        // PASO 1: Eliminar la propiedad AUTO_INCREMENT de la columna 'id'
        // Esto es crucial antes de intentar dropPrimary
            $table->integer('id')->change(); // Cambia el tipo a integer sin auto_increment

        // Eliminar la clave primaria existente si es necesario
            // y cualquier índice que dependa de 'id'
            $table->dropPrimary('id'); // Puede que necesites el nombre del índice
        });
        // Actualizar referencias en otras tablas (¡Esto es crucial y se hace antes!)
        // Esto se explica en la siguiente sección.

        Schema::table('usuario', function (Blueprint $table) {
            $table->dropColumn('id'); // Elimina la columna 'id' (integer)
        });

        Schema::table('usuario', function (Blueprint $table) {
            $table->renameColumn('uuid', 'id'); // Renombra 'uuid' a 'id'
        });

        Schema::table('usuario', function (Blueprint $table) {
            $table->primary('id'); // Establece 'id' (UUID) como clave primaria
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('usuario', function (Blueprint $table) {
            throw new \RuntimeException('Cannot revert this migration without data loss.');
        });
    }
};
