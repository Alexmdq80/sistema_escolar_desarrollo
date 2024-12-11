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
        Schema::create('inscripcion_baja', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('id_persona');
            $table->foreign('id_persona')->references('id')->on('persona');
            $table->unsignedInteger('id_inscripcion_historial')->unique();
            $table->foreign('id_inscripcion_historial')->references('id')->on('inscripcion_historial');
            $table->unsignedTinyInteger('id_pase_motivo');
            $table->foreign('id_pase_motivo')->references('id')->on('pase_motivo');
            $table->string('otro_motivo', 255)->nullable();
            $table->string('detalle', 255)->nullable();
            $table->boolean('accion_contacto')->nullable()->comment('Contacto con los adultos responsables de la o el estudiante');
            $table->boolean('accion_prevencion')->nullable()->comment('Elaboración de plan o estrategias específicas para evitar el abandono');
            $table->boolean('accion_equipo')->nullable()->comment('Articulación con Equipo de Orientación Escolar, Equipo Distrital u otros actores');
            $table->boolean('accion_otros')->nullable()->comment('Otro tipo de acción/es');
            $table->boolean('accion_ninguna')->nullable()->comment('Ninguna de las anteriores');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inscripcion_baja');
    }
};
