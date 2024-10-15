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
        Schema::table('inscripcion', function (Blueprint $table) {
            //
         // CAMBIO LA RELACIÓN DE LA COLUMNA DE LA PERSONA QUE FIRMA Y LA DIRIJO HACIA LA TABLA PERSONA
            $table->unsignedInteger('id_persona_firma')->nullable()->comment('ID de Persona. Persona que firma la inscripción')->change();
            $table->foreign('id_persona_firma')->references('id')->on('persona');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('inscripcion', function (Blueprint $table) {
            //
        });
    }
};
