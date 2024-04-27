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
        Schema::create('anio_plan', function (Blueprint $table) {
            $table->mediumIncrements('id');
            $table->smallInteger('id_plan_estudio')->unsigned();
            $table->foreign('id_plan_estudio')->references('id')->on('plan_estudio');
            $table->tinyInteger('id_ciclo_plan_estudio')->unsigned();
            $table->foreign('id_ciclo_plan_estudio')->references('id')->on('ciclo_plan_estudio');
            $table->tinyInteger('id_anio')->unsigned();
            $table->foreign('id_anio')->references('id')->on('anio');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('anio_plan');
    }
};
