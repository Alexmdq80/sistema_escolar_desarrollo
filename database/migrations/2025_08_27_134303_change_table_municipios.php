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
        Schema::table('municipios', function (Blueprint $table) {
            $table->timestamps();
            $table->softDeletes();

            $table->dropColumn('id_continente');
            $table->dropColumn('id_pais');

            $table->renameColumn('id_provincia', 'provincia_id');
            $table->renameColumn('id_fuente_georef', 'georef_fuente_id');
            $table->renameColumn('id_categoria_georef', 'georef_categoria_id');

            $table->foreign('provincia_id')
                  ->references('id')
                  ->on('provincias')
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
        Schema::table('municipios', function (Blueprint $table) {
            $table->dropTimestamps();
            $table->dropSoftDeletes();

            $table->dropForeign(['provincia_id']);
            $table->dropForeign(['georef_fuente_id']);
            $table->dropForeign(['georef_categoria_id']);

            $table->dropIndex('municipios_provincia_id_foreign');
            $table->dropIndex('municipios_georef_fuente_id_foreign');
            $table->dropIndex('municipios_georef_categoria_id_foreign');
    
            $table->tinyInteger('id_continente')->after('id')->unsigned();
            $table->tinyInteger('id_pais')->after('id')->unsigned();

            $table->renameColumn('provincia_id', 'id_provincia');
            $table->renameColumn('georef_fuente_id', 'id_fuente_georef');
            $table->renameColumn('georef_categoria_id', 'id_categoria_georef');

        });
    }
};
