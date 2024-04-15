<?php

namespace Database\Seeders;

use App\Models\Documento_Situacion;
use Illuminate\Database\Seeder;

class Documento_SituacionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $registros = Documento_Situacion::count();

        if (!$registros) {
        
            $doc_s = new Documento_Situacion();

            $doc_s->id = 1;
            $doc_s->nombre = "SÍ, Y TIENE EL DNI FÍSICO";
            $doc_s->orden = 10;
            $doc_s->vigente= true;

            $doc_s->save();

            $doc_s = new Documento_Situacion();

            $doc_s->id = 2;
            $doc_s->nombre = "SÍ, PERO NO TIENE EL DNI FÍSICO Y SE ENCUENTRA EN TRÁMITE";
            $doc_s->orden = 20;
            $doc_s->vigente= true;

            $doc_s->save();

            $doc_s = new Documento_Situacion();

            $doc_s->id = 3;
            $doc_s->nombre = "SÍ, PERO NO TIENE EL DNI FÍSICO Y NO SE ENCUENTRA EN TRÁMITE";
            $doc_s->orden = 30;
            $doc_s->vigente= true;

            $doc_s->save();

            $doc_s = new Documento_Situacion();

            $doc_s->id = 4;
            $doc_s->nombre = "NO POSEE DNI ARGENTINO";
            $doc_s->orden = 40;
            $doc_s->vigente= true;

            $doc_s->save();

            $doc_s = new Documento_Situacion();

            $doc_s->id = 5;
            $doc_s->nombre = "SÍ, PERO NO TIENE EL DNI FÍSICO";
            $doc_s->orden = 50;
            $doc_s->vigente= true;

            $doc_s->save();

            //

        }
    }
}
