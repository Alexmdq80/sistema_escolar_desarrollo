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
        Schema::create('persona_responsable', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_persona_estudiante')->unsigned();
            $table->foreign('id_persona_estudiante')->references('id')->on('persona');
            $table->integer('id_persona_responsable')->unsigned();
            $table->foreign('id_persona_responsable')->references('id')->on('persona');
            $table->tinyInteger('id_responsable_vinculo')->unsigned();
            $table->foreign('id_responsable_vinculo')->references('id')->on('responsable_vinculo');
            $table->unique(['id_persona_estudiante','id_persona_responsable'],'unique_estudiante_responsable')->constrained('persona');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('persona_responsable');
    }
};
