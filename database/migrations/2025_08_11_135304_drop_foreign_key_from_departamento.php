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
        Schema::table('departamento', function (Blueprint $table) {
            $table->dropForeign('departamento_id_provincia_foreign');
            $table->dropForeign('departamento_id_pais_foreign');
            $table->dropForeign('departamento_id_continente_foreign');
            $table->dropForeign('departamento_id_fuente_georef_foreign');
            $table->dropForeign('departamento_id_categoria_georef_foreign');
            $table->dropForeign('departamento_id_region_educativa_foreign');
        });
        Schema::table('departamento', function (Blueprint $table) {
            $table->dropUnique('departamento_distrito_numero_unique');
            $table->dropIndex('departamento_id_provincia_foreign');
            $table->dropIndex('departamento_id_pais_foreign');
            $table->dropIndex('departamento_id_continente_foreign');
            $table->dropIndex('departamento_id_fuente_georef_foreign');
            $table->dropIndex('departamento_id_categoria_georef_foreign');
            $table->dropIndex('departamento_id_region_educativa_foreign');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('departamento', function (Blueprint $table) {
            $table->unique('distrito_numero');
            $table->foreign(['id_provincia'])->references('id')->on('provincia');
            $table->foreign(['id_pais'])->references('id')->on('pais');
            $table->foreign(['id_continente'])->references('id')->on('continente');
            $table->foreign(['id_fuente_georef'])->references('id')->on('fuente_georef');
            $table->foreign(['id_categoria_georef'])->references('id')->on('categoria_georef');
            $table->foreign(['id_region_educativa'])->references('id')->on('region_educativa');
        });
    }
};
