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
        Schema::table('localidad_censal', function (Blueprint $table) {
            $table->dropForeign('localidad_censal_id_categoria_georef_foreign');
            $table->dropForeign('localidad_censal_id_continente_foreign');
            $table->dropForeign('localidad_censal_id_departamento_foreign');
            $table->dropForeign('localidad_censal_id_fuente_georef_foreign');
            $table->dropForeign('localidad_censal_id_funcion_georef_foreign');
            $table->dropForeign('localidad_censal_id_municipio_foreign');
            $table->dropForeign('localidad_censal_id_pais_foreign');
            $table->dropForeign('localidad_censal_id_provincia_foreign');
        });
        Schema::table('localidad_censal', function (Blueprint $table) {
            $table->dropIndex('localidad_censal_id_categoria_georef_foreign');
            $table->dropIndex('localidad_censal_id_continente_foreign');
            $table->dropIndex('localidad_censal_id_departamento_foreign');
            $table->dropIndex('localidad_censal_id_fuente_georef_foreign');
            $table->dropIndex('localidad_censal_id_funcion_georef_foreign');
            $table->dropIndex('localidad_censal_id_municipio_foreign');
            $table->dropIndex('localidad_censal_id_pais_foreign');
            $table->dropIndex('localidad_censal_id_provincia_foreign');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('localidad_censal', function (Blueprint $table) {
            // las claves hay que crearlas manualmente
            $table->foreign('id_categoria_georef')->references('id')->on('categoria_georef');
            //$table->foreign('id_continente')->references('id')->on('continente');
            //$table->foreign('id_departamento')->references('id')->on('departamento');
            $table->foreign('id_fuente_georef')->references('id')->on('fuente_georef');
            $table->foreign('id_funcion_georef')->references('id')->on('funcion_georef');
            //$table->foreign('id_municipio')->references('id')->on('municipio');
            //$table->foreign('id_pais')->references('id')->on('pais');
            //$table->foreign('id_provincia')->references('id')->on('provincia');
        });
    }
};
