<?php

namespace Database\Seeders;

use App\Models\Funcion_Georef;
use Illuminate\Database\Seeder;

class Funcion_GeorefSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $registros = Funcion_Georef::count();

        if (!$registros) {

            $funcion = new Funcion_Georef();

            $funcion->id = 1;
            $funcion->nombre = "CABECERA_DEPARTAMENTO";
            $funcion->orden = 10;
            $funcion->vigente = true;

            $funcion->save();

            $funcion = new Funcion_Georef();

            $funcion->id = 2;
            $funcion->nombre = "CAPITAL_PAIS";
            $funcion->orden = 20;
            $funcion->vigente = true;

            $funcion->save();

            $funcion = new Funcion_Georef();

            $funcion->id = 3;
            $funcion->nombre = "CAPITAL_PROVINCIA";
            $funcion->orden = 30;
            $funcion->vigente = true;

            $funcion->save();


        }
       //
    }
}
