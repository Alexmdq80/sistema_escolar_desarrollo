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
        if (!Schema::hasTable('provincia')) {
            Schema::create('provincia', function (Blueprint $table) {
            $table->tinyInteger('id')->unsigned()->primary();
            $table->string('id_georef', 2)->nullable();
            $table->tinyInteger('id_pais')->unsigned();
            $table->foreign('id_pais')->references('id')->on('pais');
            $table->tinyInteger('id_continente')->unsigned();
            $table->foreign('id_continente')->references('id')->on('continente');
            $table->tinyInteger('id_fuente_georef')->unsigned()->nullable();
            $table->foreign('id_fuente_georef')->references('id')->on('fuente_georef');
            $table->tinyInteger('id_categoria_georef')->unsigned()->nullable();
            $table->foreign('id_categoria_georef')->references('id')->on('categoria_georef');
            $table->string('nombre', 55);
            $table->string('nombre_completo', 70);
            $table->string('iso_nombre', 35)->nullable();
            $table->string('iso_id', 4)->nullable();
            $table->decimal('centroide_lat', 15, 13)->nullable();
            $table->decimal('centroide_lon', 15, 13)->nullable();

           // $table->string('categoria', 35)->nullable();
           // $table->string('fuente', 50)->nullable();

            /*$table->timestamps(); */
            });

        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
     //   Schema::dropIfExists('provincia');
    }
};
