<?php

namespace Database\Seeders;

use App\Models\Modalidad;
use Illuminate\Database\Seeder;

class ModalidadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $registros = Modalidad::count();

        if (!$registros) {

            $modalidad = new Modalidad();

            $modalidad->id = 1;
            $modalidad->nombre = "EDUCACIÓN COMÚN";
            $modalidad->orden = 10;
            $modalidad->vigente = true;

            $modalidad->save();

            $modalidad = new Modalidad();

            $modalidad->id = 2;
            $modalidad->nombre = "EDUCACIÓN TÉCNICO PROFESIONAL";
            $modalidad->orden = 20;
            $modalidad->vigente = true;

            $modalidad->save();

            $modalidad = new Modalidad();

            $modalidad->id = 3;
            $modalidad->nombre = "EDUCACIÓN ARTÍSTICA";
            $modalidad->orden = 30;
            $modalidad->vigente = true;

            $modalidad->save();

            $modalidad = new Modalidad();

            $modalidad->id = 4;
            $modalidad->nombre = "EDUCACIÓN ESPECIAL";
            $modalidad->orden = 40;
            $modalidad->vigente = true;

            $modalidad->save();

            $modalidad = new Modalidad();

            $modalidad->id = 5;
            $modalidad->nombre = "EDUCACIÓN PERMANENTE DE JÓVENES Y ADULTOS";
            $modalidad->orden = 50;
            $modalidad->vigente = true;

            $modalidad->save();

            $modalidad = new Modalidad();

            $modalidad->id = 6;
            $modalidad->nombre = "EDUCACIÓN RURAL";
            $modalidad->orden = 60;
            $modalidad->vigente = true;

            $modalidad->save();

            $modalidad = new Modalidad();

            $modalidad->id = 7;
            $modalidad->nombre = "EDUCACIÓN INTERCULTURAL BILINGÜE";
            $modalidad->orden = 70;
            $modalidad->vigente = true;

            $modalidad->save();

            $modalidad = new Modalidad();

            $modalidad->id = 8;
            $modalidad->nombre = "EDUCACIÓN EN CONTEXTOS DE PRIVACIÓN DE LIBERTAD";
            $modalidad->orden = 80;
            $modalidad->vigente = true;

            $modalidad->save();

            $modalidad = new Modalidad();

            $modalidad->id = 9;
            $modalidad->nombre = "EDUCACIÓN DOMICILIARIA Y HOSPITALARIA";
            $modalidad->orden = 90;
            $modalidad->vigente = true;

            $modalidad->save();

        }
        //
    }
}
