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
        Schema::table('persona', function (Blueprint $table) {
            $table->dropForeign('persona_id_documento_situacion_foreign');
            $table->dropForeign('persona_id_documento_tipo_foreign');
            $table->dropForeign('persona_id_genero_foreign');
            $table->dropForeign('persona_id_sexo_foreign');
            $table->dropForeign('persona_nacimiento_lugar_id_departamento_foreign');
            $table->dropForeign('persona_nacimiento_lugar_id_localidad_asentamiento_foreign');
            $table->dropForeign('persona_nacimiento_lugar_id_pais_foreign');
            $table->dropForeign('persona_nacimiento_lugar_id_provincia_foreign');
            $table->dropForeign('persona_nacionalidad_id_pais_foreign');
        });
        Schema::table('persona', function (Blueprint $table) {
            $table->dropIndex('persona_id_documento_situacion_foreign');
            $table->dropIndex('persona_id_documento_tipo_foreign');
            $table->dropIndex('persona_id_genero_foreign');
            $table->dropIndex('persona_id_sexo_foreign');
            $table->dropIndex('persona_nacimiento_lugar_id_departamento_foreign');
            $table->dropIndex('persona_nacimiento_lugar_id_localidad_asentamiento_foreign');
            $table->dropIndex('persona_nacimiento_lugar_id_pais_foreign');
            $table->dropIndex('persona_nacimiento_lugar_id_provincia_foreign');
            $table->dropIndex('persona_nacionalidad_id_pais_foreign');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('persona', function (Blueprint $table) {
            $table->foreign('id_documento_situacion')->references('id')->on('documento_situacion');
            $table->foreign('id_documento_tipo')->references('id')->on('documento_tipo');
            $table->foreign('id_genero')->references('id')->on('genero');
            $table->foreign('id_sexo')->references('id')->on('sexo');
            $table->foreign('nacimiento_lugar_id_departamento')->references('id')->on('departamento');
            $table->foreign('nacimiento_lugar_id_localidad_asentamiento')->references('id')->on('localidad_asentamiento');
            $table->foreign('nacimiento_lugar_id_pais')->references('id')->on('pais');
            $table->foreign('nacimiento_lugar_id_provincia')->references('id')->on('provincia');
            $table->foreign('nacionalidad_id_pais')->references('id')->on('pais');
        });
    }
};
