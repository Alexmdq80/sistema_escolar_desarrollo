<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Condicion_Finalizacion;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('condicion_finalizacion', function (Blueprint $table) {
            $table->tinyInteger('id')->unsigned()->primary();
            $table->string('nombre', 75);
            $table->tinyInteger('orden');
            $table->boolean('vigente');
            $table->timestamps();
        });
        //CREAR TABLA DE Condicion_Finalización
        $cf = new Condicion_Finalizacion();
        $cf->id = 1;
        $cf->nombre = 'EGRESA';
        $cf->orden = 10;
        $cf->vigente = true;
        $cf->save();

        $cf = new Condicion_Finalizacion();
        $cf->id = 2;
        $cf->nombre = 'FINALIZA CON ÁREAS PENDIENTES';
        $cf->orden = 20;
        $cf->vigente = true;
        $cf->save();

        $cf = new Condicion_Finalizacion();
        $cf->id = 3;
        $cf->nombre = 'REPITE';
        $cf->orden = 30;
        $cf->vigente = true;
        $cf->save();

        $cf = new Condicion_Finalizacion();
        $cf->id = 4;
        $cf->nombre = 'REPITE CON PASE A OTRO ESTABLECIMIENTO';
        $cf->orden = 40;
        $cf->vigente = true;
        $cf->save();

        $cf = new Condicion_Finalizacion();
        $cf->id = 5;
        $cf->nombre = 'CONTINÚA';
        $cf->orden = 50;
        $cf->vigente = true;
        $cf->save();

        $cf = new Condicion_Finalizacion();
        $cf->id = 6;
        $cf->nombre = 'PROMUEVE';
        $cf->orden = 60;
        $cf->vigente = true;
        $cf->save();

        $cf = new Condicion_Finalizacion();
        $cf->id = 7;
        $cf->nombre = 'PROMUEVE CON PASE A OTRO ESTABLECIMIENTO';
        $cf->orden = 70;
        $cf->vigente = true;
        $cf->save();

        $cf = new Condicion_Finalizacion();
        $cf->id = 8;
        $cf->nombre = 'PROMUEVE CON ÁREAS PENDIENTES';
        $cf->orden = 80;
        $cf->vigente = true;
        $cf->save();

        $cf = new Condicion_Finalizacion();
        $cf->id = 9;
        $cf->nombre = 'PROMUEVE CON ÁREAS PENDIENTES Y PASE A OTRO ESTABLECIMIENTO';
        $cf->orden = 90;
        $cf->vigente = true;
        $cf->save();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('condicion_finalizacion');
    }
};
