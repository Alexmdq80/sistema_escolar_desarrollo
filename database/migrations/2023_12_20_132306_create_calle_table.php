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
        if (!Schema::hasTable('calle')) {
            Schema::create('calle', function (Blueprint $table) {
                    $table->mediumIncrements('id');
                    $table->string('id_georef', 13)->nullable();
                    $table->smallInteger('id_departamento')->unsigned()->nullable();
                    $table->foreign('id_departamento')->references('id')->on('departamento');
                    $table->tinyInteger('id_provincia')->unsigned()->nullable();
                    $table->foreign('id_provincia')->references('id')->on('provincia');
                    $table->tinyInteger('id_pais')->unsigned();
                    $table->foreign('id_pais')->references('id')->on('pais');
                    $table->tinyInteger('id_continente')->unsigned();
                    $table->foreign('id_continente')->references('id')->on('continente');
                    $table->smallInteger('id_localidad_censal')->unsigned()->nullable();
                    $table->foreign('id_localidad_censal')->references('id')->on('localidad_censal');
                    $table->tinyInteger('id_fuente_georef')->unsigned()->nullable();
                    $table->foreign('id_fuente_georef')->references('id')->on('fuente_georef');
                    $table->tinyInteger('id_categoria_georef')->unsigned()->nullable();
                    $table->foreign('id_categoria_georef')->references('id')->on('categoria_georef');
                    $table->string('nombre', 55);
                    $table->integer('altura_fin_derecha')->nullable();
                    $table->integer('altura_fin_izquierda')->nullable();
                    $table->integer('altura_inicio_derecha')->nullable();
                    $table->integer('altura_inicio_izquierda')->nullable();
                    // $table->string('fuente', 50)->nullable();
                    // $table->string('categoria', 50)->nullable();
            });
        }
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
     //   Schema::dropIfExists('calle');
    }
};
