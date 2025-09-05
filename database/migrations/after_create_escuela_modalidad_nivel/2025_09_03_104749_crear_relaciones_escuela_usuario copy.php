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
        Schema::table('escuela_usuario', function (Blueprint $table) {
            $table->foreign('escuela_id')
                  ->references('id')
                  ->on('escuelas')
                  ->onDelete('restrict');

            $table->foreign('usuario_id')
                  ->references('id')
                  ->on('usuarios')
                  ->onDelete('restrict');

            $table->foreign('usuario_tipo_id')
                  ->references('id')
                  ->on('usuario_tipos')
                  ->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('escuela_usuario', function (Blueprint $table) {

            $table->dropForeign(['escuela_id']);
            $table->dropForeign(['usuario_id']);
            $table->dropForeign(['usuario_tipo_id']);

            $table->dropIndex('escuela_usuario_escuela_id_foreign');
            $table->dropIndex('escuela_usuario_usuario_id_foreign');
            $table->dropIndex('escuela_usuario_usuario_tipo_id_foreign'); 
    
        });

    }
};
