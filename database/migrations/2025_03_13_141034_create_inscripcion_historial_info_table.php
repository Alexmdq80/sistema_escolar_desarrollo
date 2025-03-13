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
        Schema::create('inscripcion_historial_info', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_inscripcion_historial')->unique();
            $table->foreign('id_inscripcion_historial')->references('id')->on('inscripcion_historial');
            $table->date('fecha')->nullable();
            $table->string('observaciones', 255)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inscripcion_historial_info');
    }
};
