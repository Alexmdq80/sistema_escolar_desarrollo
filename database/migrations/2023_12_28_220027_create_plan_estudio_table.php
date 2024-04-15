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
        Schema::create('plan_estudio', function (Blueprint $table) {
            $table->smallIncrements('id');
            $table->tinyInteger('id_plan_ciclo')->unsigned();
            $table->foreign('id_plan_ciclo')->references('id')->on('plan_ciclo');
            $table->string('nombre', 60);
            $table->string('nombre_completo', 120);
            $table->tinyInteger('duracion_anios')->unsigned();
            $table->string('resolucion', 70);
            $table->string('orientacion', 70);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plan_estudio');
    }
};
