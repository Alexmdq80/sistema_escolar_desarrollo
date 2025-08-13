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
        Schema::table('provincia', function (Blueprint $table) {

            $table->dropForeign('provincia_id_continente_foreign');
            $table->dropForeign('provincia_id_pais_foreign');
            $table->dropForeign('provincia_id_fuente_georef_foreign');
            $table->dropForeign('provincia_id_categoria_georef_foreign');
        });
        Schema::table('provincia', function (Blueprint $table) {
            $table->dropIndex('provincia_id_continente_foreign');
            $table->dropIndex('provincia_id_pais_foreign');
            $table->dropIndex('provincia_id_fuente_georef_foreign');
            $table->dropIndex('provincia_id_categoria_georef_foreign');
        });            
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('provincia', function (Blueprint $table) {
            $table->foreign('id_continente')->references('id')->on('continente');
            $table->foreign('id_pais')->references('id')->on('pais');
            $table->foreign('id_fuente_georef')->references('id')->on('fuente_georef');
            $table->foreign('id_categoria_georef')->references('id')->on('categoria_georef');
        });
    }
};
