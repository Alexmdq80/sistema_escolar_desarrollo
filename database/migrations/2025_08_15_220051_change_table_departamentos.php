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
        Schema::table('departamentos', function (Blueprint $table) {
            $table->timestamps();

            $table->softDeletes();
            // * ojo que se borran los datos!!!
            $table->dropColumn('id_pais');
            $table->dropColumn('id_continente');

            $table->renameColumn('id_provincia', 'provincia_id');
            $table->renameColumn('id_fuente_georef', 'georef_fuente_id');
            $table->renameColumn('id_categoria_georef', 'georef_categoria_id');
            $table->renameColumn('id_region_educativa', 'region_id');

            $table->foreign('provincia_id')
                  ->references('id')
                  ->on('provincias')
                  ->onDelete('restrict');

            $table->foreign('region_id')
                  ->references('id')
                  ->on('regions')
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
        Schema::table('departamentos', function (Blueprint $table) {
            $table->dropForeign(['provincia_id']);
            $table->dropForeign(['region_id']);
            $table->dropForeign(['georef_fuente_id']);
            $table->dropForeign(['georef_categoria_id']);

            $table->dropIndex('departamentos_provincia_id_foreign');
            $table->dropIndex('departamentos_region_id_foreign');
            $table->dropIndex('departamentos_georef_fuente_id_foreign');
            $table->dropIndex('departamentos_georef_categoria_id_foreign');

            $table->renameColumn('provincia_id', 'id_provincia');
            $table->renameColumn('region_id', 'id_region_educativa');

            $table->renameColumn('georef_fuente_id', 'id_fuente_georef');
            $table->renameColumn('georef_categoria_id', 'id_categoria_georef');

            $table->tinyInteger('id_pais')->after('id')->unsigned();
            $table->tinyInteger('id_continente')->after('id')->unsigned();

            $table->dropSoftDeletes();
            $table->dropTimestamps();
        });
    }
};
