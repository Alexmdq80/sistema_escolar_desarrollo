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
        Schema::create('estudiante_adulto_vinculo', function (Blueprint $table) {
            $table->id('id');
            
            $table->integer('id_persona_estudiante')->unsigned();
            $table->foreign('id_persona_estudiante')->references('id')->on('persona');
            
            $table->integer('id_persona_adulto')->unsigned();
            $table->foreign('id_persona_adulto')->references('id')->on('persona');
            
            $table->tinyInteger('id_adulto_vinculo')->unsigned();
            $table->foreign('id_adulto_vinculo')->references('id')->on('adulto_vinculo');
            
            $table->string('detalle', 255)->nullable();
            $table->date('vencimiento_fecha')->nullable();
            $table->timestamps();

            // $table->unique(['id_persona_estudiante','id_persona_adulto'],'unique_estudiante_adulto');
            // QUITO LA CLAVE ÚNICA, YA QUE PUEDE HABER UN RESPONSABLE QUE ESTÉ RESTRINGIDO
            // $table->smallInteger('id_inscripcion')->unsigned();
            // $table->foreign('id_inscripcion')->references('id')->on('inscripcion')->constrained('inscripcion')->onDelete('cascade');
            // $table->unique(['id_inscripcion','id_persona_estudiante','id_persona_adulto'],'unique_estudiante_responsable')
            //       ->constrained('persona')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('estudiante_adulto_vinculo');
    }
};
