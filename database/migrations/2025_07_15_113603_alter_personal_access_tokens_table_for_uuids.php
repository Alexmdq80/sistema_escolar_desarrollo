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
        Schema::table('personal_access_tokens', function (Blueprint $table) {
            // Eliminar el índice existente en la columna antigua (tokenable_type, tokenable_id)
            // Sanctum crea un índice morfo por defecto. Debemos eliminarlo antes de cambiar el tipo.
            $table->dropIndex(['tokenable_type', 'tokenable_id']);

            // Cambiar el tipo de 'tokenable_id' a UUID
            // Asumimos que 'tokenable_id' era un BIGINT y ahora será un UUID (CHAR(36))
            $table->uuid('tokenable_id')->change(); // Cambia el tipo de la columna existente

            // Volver a crear el índice en la columna de ID (ahora UUID)
            $table->index(['tokenable_type', 'tokenable_id']);

            // Opcional: Si antes tenías una clave foránea (Sanctum no la añade por defecto)
            // y la eliminaste en un paso anterior, podrías volver a añadirla aquí.
            // $table->foreign('tokenable_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('personal_access_tokens', function (Blueprint $table) {
            // En el método down, revertimos los cambios.
            // Eliminar el índice de la columna UUID
            $table->dropIndex(['tokenable_type', 'tokenable_id']);

            // Cambiar el tipo de 'tokenable_id' de vuelta a BIGINT
            $table->unsignedBigInteger('tokenable_id')->change();

            // Volver a crear el índice original
            $table->index(['tokenable_type', 'tokenable_id']);
        });
    }
};
