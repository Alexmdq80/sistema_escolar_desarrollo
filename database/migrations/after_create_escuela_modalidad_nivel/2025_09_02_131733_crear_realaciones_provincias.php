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
        Schema::table('provincias', function (Blueprint $table) {

            $table->foreign('nacion_id')
                  ->references('id')
                  ->on('nacions')
                  ->onDelete('restrict');

            $table->foreign('georef_fuente_id')
                  ->references('id')
                  ->on('georef_fuentes')
                  ->onDelete('restrict');

            $table->foreign('georef_categoria_id')
                  ->references('id')
                  ->on('georef_categorias')
                  ->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('provincias', function (Blueprint $table) {

            $table->dropForeign(['nacion_id']);
            $table->dropForeign(['georef_fuente_id']);
            $table->dropForeign(['georef_categoria_id']);

            $table->dropIndex('provincias_nacion_id_foreign');
            $table->dropIndex('provincias_georef_fuente_id_foreign');
            $table->dropIndex('provincias_georef_categoria_id_foreign');
        });
    }
};
