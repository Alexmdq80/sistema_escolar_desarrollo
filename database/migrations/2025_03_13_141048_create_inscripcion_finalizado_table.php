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
        Schema::create('inscripcion_finalizado', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('id_inscripcion_historial')->unique();
            $table->foreign('id_inscripcion_historial')->references('id')->on('inscripcion_historial');
            $table->unsignedTinyInteger('id_condicion_finalizacion')->nullable();
            $table->foreign('id_condicion_finalizacion')->references('id')->on('condicion');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inscripcion_finalizado');
    }
};
