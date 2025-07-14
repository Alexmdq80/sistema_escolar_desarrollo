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
            $table->uuid('created_by')->nullable()->after('updated_at');
            // updated_by: id del usuario que actualizó el registro por última vez
            $table->uuid('updated_by')->nullable()->after('created_by');
            // Opcional pero ALTAMENTE RECOMENDADO: Añadir claves foráneas.
            // Esto asegura la integridad referencial y que los IDs apunten a usuarios válidos.
            // 'onDelete('set null')' significa que si el usuario creador/actualizador es eliminado,
            // estos campos se establecerán en NULL en lugar de eliminar el registro.
            $table->foreign('created_by')->references('id')->on('usuario')->onDelete('set null');
            $table->foreign('updated_by')->references('id')->on('usuario')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('usuario', function (Blueprint $table) {
            // Es importante eliminar las claves foráneas ANTES de eliminar las columnas.
            $table->dropForeign(['created_by']);
            $table->dropForeign(['updated_by']);

            // Luego elimina las columnas.
            $table->dropColumn('created_by');
            $table->dropColumn('updated_by');
        });
    }
};
