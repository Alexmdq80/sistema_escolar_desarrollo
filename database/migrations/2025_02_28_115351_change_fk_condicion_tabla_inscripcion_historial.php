<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Condicion;
use App\Models\Condicion_Finalizacion;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {

        Schema::table('inscripcion_historial', function (Blueprint $table) {
             $table->dropForeign('inscripcion_historial_id_condicion_finalizacion_foreign');
        });
        Schema::table('inscripcion_historial', function (Blueprint $table) {
            $table->foreign('id_condicion_finalizacion')->references('id')->on('condicion');
          });
        Schema::table('condicion', function (Blueprint $table) {
            $table->string('nombre', 75)->change();
        });

        $c = new Condicion();
        $c->id = 7;
        $c->nombre = 'REPITENTE CON PASE A OTRO ESTABLECIMIENTO';
        $c->vigente = true;
        $c->orden = 70;
        $c->save();

        $c = new Condicion();
        $c->id = 8;
        $c->nombre = 'PROMOVIDO/A CON PASE A OTRO ESTABLECIMIENTO';
        $c->vigente = true;
        $c->orden = 80;
        $c->save();

        $c = new Condicion();
        $c->id = 9;
        $c->nombre = 'PROMOVIDO/A CON ÁREAS PENDIENTES Y PASE A OTRO ESTABLECIMIENTO';
        $c->vigente = true;
        $c->orden = 90;
        $c->save();

        $c = new Condicion();
        $c->id = 10;
        $c->nombre = 'EGRESADO';
        $c->vigente = true;
        $c->orden = 100;
        $c->save();

        $c = new Condicion();
        $c->id = 11;
        $c->nombre = 'FINALIZADO CON ÁREAS PENDIENTES';
        $c->vigente = true;
        $c->orden = 110;
        $c->save();

        Schema::dropIfExists('condicion_finalizacion');
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
       Condicion::destroy([7, 8, 9, 10, 11]);

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

        Schema::table('inscripcion_historial', function (Blueprint $table) {
           $table->dropForeign('inscripcion_historial_id_condicion_finalizacion_foreign');
        });
        Schema::table('inscripcion_historial', function (Blueprint $table) {
            $table->foreign('id_condicion_finalizacion')->references('id')->on('condicion_finalizacion');
        });


    }
};
