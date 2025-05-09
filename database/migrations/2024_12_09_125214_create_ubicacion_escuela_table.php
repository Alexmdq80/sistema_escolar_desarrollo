<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Ubicacion_Escuela;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('ubicacion_escuela', function (Blueprint $table) {
            $table->tinyInteger('id')->unsigned()->primary();
            $table->string('nombre', 75);
            $table->tinyInteger('orden');
            $table->boolean('vigente');
            $table->timestamps();

        });

        //CREAR TABLA DE UBICACIÓN ESCUELA
        $ue = new Ubicacion_Escuela();
        $ue->id = 1;
        $ue->nombre = 'MISMO DISTRITO';
        $ue->orden = 10;
        $ue->vigente = true;
        $ue->save();

        $ue = new Ubicacion_Escuela();
        $ue->id = 2;
        $ue->nombre = 'OTRO DISTRITO DE LA MISMA REGIÓN EDUCATIVA';
        $ue->orden = 20;
        $ue->vigente = true;
        $ue->save();

        $ue = new Ubicacion_Escuela();
        $ue->id = 3;
        $ue->nombre = 'OTRA REGIÓN EDUCATIVA DE LA PROVINCIA DE BUENOS AIRES';
        $ue->orden = 30;
        $ue->vigente = true;
        $ue->save();

        $ue = new Ubicacion_Escuela();
        $ue->id = 4;
        $ue->nombre = 'OTRA PROVINCIA O CABA';
        $ue->orden = 40;
        $ue->vigente = true;
        $ue->save();

        $ue = new Ubicacion_Escuela();
        $ue->id = 5;
        $ue->nombre = 'OTRO PAÍS';
        $ue->orden = 50;
        $ue->vigente = true;
        $ue->save();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ubicacion_escuela');
    }
};
