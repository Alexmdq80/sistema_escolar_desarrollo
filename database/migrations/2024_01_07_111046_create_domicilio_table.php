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
        Schema::create('domicilio', function (Blueprint $table) {
            $table->integerIncrements('id');
            $table->integer('id_persona')->unsigned()->unique();
            $table->foreign('id_persona')->references('id')->on('persona');
            $table->mediumInteger('id_calle')->unsigned()->nullable();
            $table->foreign('id_calle')->references('id')->on('calle');
            $table->mediumInteger('id_calle_entre1')->unsigned()->nullable();
            $table->foreign('id_calle_entre1')->references('id')->on('calle');
            $table->mediumInteger('id_calle_entre2')->unsigned()->nullable();
            $table->foreign('id_calle_entre2')->references('id')->on('calle');
            $table->tinyInteger('id_pais')->unsigned()->nullable();
            $table->foreign('id_pais')->references('id')->on('pais');
            $table->tinyInteger('id_provincia')->unsigned()->nullable();
            $table->foreign('id_provincia')->references('id')->on('provincia');
            $table->smallInteger('id_departamento')->unsigned()->nullable();
            $table->foreign('id_departamento')->references('id')->on('departamento');
            $table->smallInteger('id_localidad_asentamiento')->unsigned()->nullable();
            $table->foreign('id_localidad_asentamiento')->references('id')->on('localidad_asentamiento');
            $table->unsignedInteger('numero')->nullable();
            $table->string('piso', 5)->nullable();
            $table->string('torre', 10)->nullable();
            $table->string('departamento', 5)->nullable();
            $table->string('otros', 50)->nullable();
            $table->string('codigo_postal', 10)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('domicilio');
    }
};
