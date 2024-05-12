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
        Schema::create('estudiante_adulto', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_persona_estudiante')->unsigned();
            $table->foreign('id_persona_estudiante')->references('id')->on('persona');
            $table->integer('id_persona_adulto')->unsigned();
            $table->foreign('id_persona_adulto')->references('id')->on('persona');
            $table->string('vinculable_type',255);
            $table->tinyInteger('vinculable_id')->unsigned();
            $table->unique(['id_persona_estudiante','id_persona_adulto'],'unique_estudiante_responsable')->constrained('persona');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('estudiante_adulto');
    }
};
