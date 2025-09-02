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
        Schema::table('espacios', function (Blueprint $table) {
            $table->foreign('propuesta_id')
                  ->references('id')
                  ->on('propuestas')
                  ->onDelete('restrict');

            $table->foreign('seccion_tipo_id')
                  ->references('id')
                  ->on('seccion_tipos')
                  ->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('espacios', function (Blueprint $table) {

            $table->dropForeign(['propuesta_id']);
            $table->dropForeign(['seccion_tipo_id']);

            $table->dropIndex('espacios_propuesta_id_foreign');
            $table->dropIndex('espacios_seccion_tipo_id_foreign');
    
        });

    }
};
