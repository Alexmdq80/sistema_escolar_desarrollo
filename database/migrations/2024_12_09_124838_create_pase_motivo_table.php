<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Pase_Motivo;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pase_motivo', function (Blueprint $table) {
            $table->tinyInteger('id')->unsigned()->primary();
            $table->string('nombre', 75);
            $table->tinyInteger('orden');
            $table->boolean('vigente');
            $table->timestamps();

        });
        //CREAR TABLA DE PASE_MOTIVO
        $pm = new Pase_Motivo();
        $pm->id = 1;
        $pm->nombre = 'Mudanza';
        $pm->orden = 10;
        $pm->vigente = true;
        $pm->save();

        $pm = new Pase_Motivo();
        $pm->id = 2;
        $pm->nombre = 'Distancia a la escuela';
        $pm->orden = 20;
        $pm->vigente = true;
        $pm->save();

        $pm = new Pase_Motivo();
        $pm->id = 3;
        $pm->nombre = 'Dificultades económicas';
        $pm->orden = 30;
        $pm->vigente = true;
        $pm->save();

        $pm = new Pase_Motivo();
        $pm->id = 4;
        $pm->nombre = 'Situación de salud del estudiante';
        $pm->orden = 40;
        $pm->vigente = true;
        $pm->save();

        $pm = new Pase_Motivo();
        $pm->id = 5;
        $pm->nombre = 'Trabajo del responsable';
        $pm->orden = 50;
        $pm->vigente = true;
        $pm->save();

        $pm = new Pase_Motivo();
        $pm->id = 6;
        $pm->nombre = 'Otro';
        $pm->orden = 60;
        $pm->vigente = true;
        $pm->save();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pase_motivo');
    }
};
