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
        Schema::create('persona', function (Blueprint $table) {
            $table->integerIncrements('id');
            $table->tinyInteger('id_documento_tipo')->unsigned()->nullable();
            $table->foreign('id_documento_tipo')->references('id')->on('documento_tipo');
            $table->tinyInteger('id_documento_situacion')->unsigned()->nullable();
            $table->foreign('id_documento_situacion')->references('id')->on('documento_situacion');
            $table->tinyInteger('id_sexo')->unsigned()->nullable();
            $table->foreign('id_sexo')->references('id')->on('sexo');
            $table->tinyInteger('id_genero')->unsigned()->nullable();
            $table->foreign('id_genero')->references('id')->on('genero');
            $table->tinyInteger('nacionalidad_id_pais')->unsigned()->nullable();
            $table->foreign('nacionalidad_id_pais')->references('id')->on('pais');
            $table->tinyInteger('nacimiento_lugar_id_pais')->unsigned()->nullable();
            $table->foreign('nacimiento_lugar_id_pais')->references('id')->on('pais');
            $table->tinyInteger('nacimiento_lugar_id_provincia')->unsigned()->nullable();
            $table->foreign('nacimiento_lugar_id_provincia')->references('id')->on('provincia');
            $table->smallInteger('nacimiento_lugar_id_departamento')->unsigned()->nullable();
            $table->foreign('nacimiento_lugar_id_departamento')->references('id')->on('departamento');
            $table->smallInteger('nacimiento_lugar_id_localidad_asentamiento')->unsigned()->nullable();
            $table->foreign('nacimiento_lugar_id_localidad_asentamiento')->references('id')->on('localidad_asentamiento');
            $table->Integer('documento_numero')->unsigned()->nullable();
            $table->string('apellido', 50);
            $table->string('nombre', 50);
            $table->string('nombre_alternativo', 50)->nullable();
            $table->bigInteger('tramite')->unsigned()->nullable();
            $table->boolean('posee_cpi_si')->nullable();
            $table->boolean('posee_docExt_si')->nullable();
            $table->boolean('vive_si')->nullable();
            $table->tinyInteger('CUIL_prefijo')->nullable();
            $table->tinyInteger('CUIL_sufijo')->nullable();
            $table->date('nacimiento_fecha')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('persona');
    }
};
