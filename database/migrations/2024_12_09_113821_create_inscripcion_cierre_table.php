<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Inscripcion_Cierre;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('inscripcion_cierre', function (Blueprint $table) {
            $table->tinyInteger('id')->unsigned()->primary();
            $table->string('nombre', 50);
            $table->tinyInteger('orden');
            $table->boolean('vigente');
            $table->timestamps();

        });


        //CREAR TABLA DE INSCRIPCION_CIERRE
        $ic = new Inscripcion_Cierre();
        $ic->id = 1;
        $ic->nombre = 'FINALIZADO';
        $ic->orden = 10;
        $ic->vigente = true;
        $ic->save();

        $ic = new Inscripcion_Cierre();
        $ic->id = 2;
        $ic->nombre = 'BAJA CON PASE';
        $ic->orden = 20;
        $ic->vigente = true;
        $ic->save();

        $ic = new Inscripcion_Cierre();
        $ic->id = 3;
        $ic->nombre = 'BAJA SIN PASE';
        $ic->orden = 30;
        $ic->vigente = true;
        $ic->save();

        $ic = new Inscripcion_Cierre();
        $ic->id = 4;
        $ic->nombre = 'ELIMINADO';
        $ic->orden = 40;
        $ic->vigente = true;
        $ic->save();

        $ic = new Inscripcion_Cierre();
        $ic->id = 5;
        $ic->nombre = 'REUBICADO';
        $ic->orden = 50;
        $ic->vigente = true;
        $ic->save();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inscripcion_cierre');
    }
};
