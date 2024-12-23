<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Tipo_Escuela;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tipo_escuela', function (Blueprint $table) {
            $table->tinyInteger('id')->unsigned()->primary();
            $table->string('nombre', 75);
            $table->tinyInteger('orden');
            $table->boolean('vigente');
            $table->timestamps();
        });

         //CREAR TABLA DE TIPO ESCUELA
         $te = new Tipo_Escuela();
         $te->id = 1;
         $te->nombre = 'SECUNDARIA ORIENTADA (MS/BS/MM)';
         $te->orden = 10;
         $te->vigente = true;
         $te->save();

         $te = new Tipo_Escuela();
         $te->id = 2;
         $te->nombre = 'SECUNDARIA AGRARIA / CEPT (MA/MC)';
         $te->orden = 20;
         $te->vigente = true;
         $te->save();

         $te = new Tipo_Escuela();
         $te->id = 3;
         $te->nombre = 'SECUNDARIA TÉCNICA (MT)';
         $te->orden = 30;
         $te->vigente = true;
         $te->save();

         $te = new Tipo_Escuela();
         $te->id = 4;
         $te->nombre = 'SECUNDARIA ESPECIALIZADA EN ARTE (AS)';
         $te->orden = 40;
         $te->vigente = true;
         $te->save();

         $te = new Tipo_Escuela();
         $te->id = 5;
         $te->nombre = 'MODALIDAD ESPECIAL';
         $te->orden = 50;
         $te->vigente = true;
         $te->save();

         $te = new Tipo_Escuela();
         $te->id = 6;
         $te->nombre = 'MODALIDAD JÓVENES Y ADULTOS';
         $te->orden = 60;
         $te->vigente = true;
         $te->save();

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tipo_escuela');
    }
};
