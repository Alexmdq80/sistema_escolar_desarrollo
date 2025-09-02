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
        Schema::table('georef_asentamientos', function (Blueprint $table) {

            $table->foreign('departamento_id')
                  ->references('id')
                  ->on('departamentos')
                  ->onDelete('restrict');

            $table->foreign('municipio_id')
                  ->references('id')
                  ->on('municipios')
                  ->onDelete('restrict');

            $table->foreign('localidad_censal_id')
                  ->references('id')
                  ->on('localidad_censals')
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
        Schema::table('georef_asentamientos', function (Blueprint $table) {            
            $table->dropForeign(['departamento_id']);
            $table->dropForeign(['municipio_id']);
            $table->dropForeign(['localidad_censal_id']);
            $table->dropForeign(['georef_fuente_id']);
            $table->dropForeign(['georef_categoria_id']);

            $table->dropIndex('georef_asentamientos_departamento_id_foreign');
            $table->dropIndex('georef_asentamientos_municipio_id_foreign');
            $table->dropIndex('georef_asentamientos_localidad_censal_id_foreign');
            $table->dropIndex('georef_asentamientos_georef_fuente_id_foreign');
            $table->dropIndex('georef_asentamientos_georef_categoria_id_foreign');
        });
    }
};
