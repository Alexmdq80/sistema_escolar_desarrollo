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
            $table->timestamps();
            $table->softDeletes();
            // NO OLVIDARSE DE CORRER EL SEEDER PARA CORREGIR LA BD

            // * ojo que se borran los datos!!!
            $table->dropColumn('id_continente');
            $table->dropColumn('id_pais');

            $table->renameColumn('id_fuente_georef', 'georef_fuente_id');
            $table->renameColumn('id_categoria_georef', 'georef_categoria_id');
            $table->renameColumn('id_funcion_georef', 'georef_funcion_id');

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
            $table->dropTimestamps();
            $table->dropSoftDeletes();

            $table->dropForeign(['georef_fuente_id']);
            $table->dropForeign(['georef_categoria_id']);
            $table->dropForeign(['georef_funcion_id']);

            $table->dropIndex('localidad_censals_georef_fuente_id_foreign');
            $table->dropIndex('localidad_censals_georef_categoria_id_foreign');
            $table->dropIndex('localidad_censals_georef_funcion_id_foreign');

            $table->tinyInteger('id_continente')->after('id')->unsigned();
            $table->tinyInteger('id_pais')->after('id')->unsigned();

            $table->renameColumn('georef_fuente_id', 'id_fuente_georef');
            $table->renameColumn('georef_categoria_id', 'id_categoria_georef');
            $table->renameColumn('georef_funcion_id', 'id_funcion_georef');

        });
    }
};
