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
        Schema::table('localidad_censals', function (Blueprint $table) {
            $table->foreign('georef_fuente_id')
                  ->references('id')
                  ->on('georef_fuentes')
                  ->onDelete('restrict');

            $table->foreign('georef_categoria_id')
                  ->references('id')
                  ->on('georef_categorias')
                  ->onDelete('restrict');

            $table->foreign('georef_funcion_id')
                  ->references('id')
                  ->on('georef_funcions')
                  ->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('localidad_censals', function (Blueprint $table) {
            $table->dropForeign(['georef_fuente_id']);
            $table->dropForeign(['georef_categoria_id']);
            $table->dropForeign(['georef_funcion_id']);

            $table->dropIndex('localidad_censals_georef_fuente_id_foreign');
            $table->dropIndex('localidad_censals_georef_categoria_id_foreign');
            $table->dropIndex('localidad_censals_georef_funcion_id_foreign');
        });
    }
};
