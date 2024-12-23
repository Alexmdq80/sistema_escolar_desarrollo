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
        Schema::create('inscripcion_pase', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedMediumInteger('id_escuela')->nullable();
            $table->foreign('id_escuela')->references('id')->on('escuela');
            $table->tinyInteger('id_region_educativa')->unsigned()->nullable();
            $table->foreign('id_region_educativa')->references('id')->on('region_educativa');
            $table->smallInteger('id_departamento_escuela')->unsigned()->nullable();
            $table->foreign('id_departamento_escuela')->references('id')->on('departamento');
            $table->tinyInteger('id_provincia_escuela')->unsigned()->nullable();
            $table->foreign('id_provincia_escuela')->references('id')->on('provincia');
            $table->tinyInteger('id_pais_escuela')->unsigned()->nullable();;
            $table->foreign('id_pais_escuela')->references('id')->on('pais');
            $table->unsignedInteger('id_inscripcion_historial');
            $table->foreign('id_inscripcion_historial')->references('id')->on('inscripcion_historial');
            $table->unsignedTinyInteger('id_pase_motivo')->nullable();;
            $table->foreign('id_pase_motivo')->references('id')->on('pase_motivo');
            $table->unsignedTinyInteger('id_ubicacion_escuela')->nullable();;
            $table->foreign('id_ubicacion_escuela')->references('id')->on('ubicacion_escuela');
            $table->unsignedTinyInteger('id_tipo_escuela')->nullable();;
            $table->foreign('id_tipo_escuela')->references('id')->on('tipo_escuela');
            $table->string('otro_motivo', 255)->nullable();
            $table->string('observaciones', 255)->nullable();
            $table->date('fecha')->nullable();
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inscripcion_pase');
    }
};
