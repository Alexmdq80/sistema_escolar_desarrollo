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
        Schema::table('escuela', function (Blueprint $table) {

            $table->dropForeign('escuela_id_ambito_foreign');
            $table->dropForeign('escuela_id_continente_foreign');
            $table->dropForeign('escuela_id_dependencia_foreign');
            $table->dropForeign('escuela_id_pais_foreign');
            $table->dropForeign('escuela_id_sector_foreign');

        });
        Schema::table('escuela', function (Blueprint $table) {
            $table->dropUnique('escuela_cue_anexo_unique');
            $table->dropIndex('escuela_id_localidad_asentamiento_foreign');
          //  $table->dropIndex('escuela_id_localidad_asentamiento_index');
          //  $table->dropIndex('escuela_id_departamento_index');
          //  $table->dropIndex('escuela_id_provincia_index');
            $table->dropIndex('escuela_id_departamento_foreign');
            $table->dropIndex('escuela_id_provincia_foreign');

            $table->dropIndex('escuela_id_pais_foreign');
            $table->dropIndex('escuela_id_continente_foreign');
            $table->dropIndex('escuela_id_ambito_foreign');
            $table->dropIndex('escuela_id_dependencia_foreign');
            $table->dropIndex('escuela_id_sector_foreign');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('escuela', function (Blueprint $table) {
            $table->unique(['cue_anexo']);
            $table->index(['id_localidad_asentamiento']);
            $table->index(['id_departamento']);
            $table->index(['id_provincia']);
            // algunas claves hay que agregarlas manualmente
            $table->foreign(['id_ambito'])->references('id')->on('ambito');
            //$table->foreign(['id_continente'])->references('id')->on('continente');
            $table->foreign(['id_dependencia'])->references('id')->on('dependencia');
            //$table->foreign(['id_pais'])->references('id')->on('pais');
            $table->foreign(['id_sector'])->references('id')->on('sector');


        });
    }
};
