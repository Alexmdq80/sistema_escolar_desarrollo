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
        Schema::create('anio', function (Blueprint $table) {
            $table->tinyIncrements('id');
            $table->tinyInteger('id_plan_ciclo')->unsigned();
            $table->foreign('id_plan_ciclo')->references('id')->on('plan_ciclo');
            // el nombre es como quiero que aparezca en pantalla.
            // por ej. A.F., el nombre completo será AULA DE FORTALECIMIENT
            // NOMBRE: 1, COMPLETO: PRIMERO.
            $table->string('nombre',30);
            $table->string('nombre_completo',60);
            // EL AÑO ABSOLUTO ES EL AÑO QUE CORRESPONDE
            // AL SECUNDARIO, EN EL CASO ACTUAL DE 1 A 6.
            $table->tinyInteger('anio_absoluto');
            // EL AÑÓ RELATIVO ES EL AÑÓ QUE CORRESPONDE
            // AL CILO DE AÑOS, BÁSICO O SUPERIOR. 1 A 3 AÑOS.
            // POR EJ. AÑO RELATIVO 1 CICLO SUPERIOR
            // ES AÑO ABSOLUTO 4 SECUNDARIO
            $table->tinyInteger('anio_relativo');
            $table->tinyInteger('orden');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('anio');
    }
};
