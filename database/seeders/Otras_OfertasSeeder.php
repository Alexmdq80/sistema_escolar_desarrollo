<?php

namespace Database\Seeders;

use App\Models\Otras_Ofertas;
use Illuminate\Database\Seeder;

class Otras_OfertasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $registros = Otras_Ofertas::count();

        if (!$registros) {

            $registro = new Otras_Ofertas();

            $registro->id = 1;
            $registro->nombre = "EDUCACIÓN COMÚN - MATERNAL";
            $registro->orden = 10;
            $registro->vigente = true;

            $registro->save();

            $registro = new Otras_Ofertas();

            $registro->id = 2;
            $registro->nombre = "EDUCACIÓN COMÚN - SUPERIOR (CURSOS)";
            $registro->orden = 20;
            $registro->vigente = true;

            $registro->save();

            $registro = new Otras_Ofertas();

            $registro->id = 3;
            $registro->nombre = "EDUCACIÓN ESPECIAL - ESTIMULACIÓN TEMPRANA";
            $registro->orden = 30;
            $registro->vigente = true;

            $registro->save();

            $registro = new Otras_Ofertas();

            $registro->id = 4;
            $registro->nombre = "EDUCACIÓN ESPECIAL - INTEGRACIÓN";
            $registro->orden = 40;
            $registro->vigente = true;

            $registro->save();

            $registro = new Otras_Ofertas();

            $registro->id = 5;
            $registro->nombre = "EDUCACIÓN ADULTOS - PROFESIONAL";
            $registro->orden = 50;
            $registro->vigente = true;

            $registro->save();

            $registro = new Otras_Ofertas();

            $registro->id = 6;
            $registro->nombre = "EDUCACIÓN ADULTOS - PROFESIONAL INET";
            $registro->orden = 60;
            $registro->vigente = true;

            $registro->save();

            $registro = new Otras_Ofertas();

            $registro->id = 7;
            $registro->nombre = "EDUCACIÓN ADULTOS - ALFABETIZACIÓN";
            $registro->orden = 70;
            $registro->vigente = true;

            $registro->save();

            $registro = new Otras_Ofertas();

            $registro->id = 8;
            $registro->nombre = "TALLERES DE ARTÍSTICA";
            $registro->orden = 80;
            $registro->vigente = true;

            $registro->save();


            $registro = new Otras_Ofertas();

            $registro->id = 9;
            $registro->nombre = "SERVICIOS COMPLEMENTARIOS";
            $registro->orden = 90;
            $registro->vigente = true;

            $registro->save();


        }
        //
    }
}
