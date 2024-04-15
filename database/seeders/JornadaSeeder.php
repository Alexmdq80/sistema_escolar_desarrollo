<?php

namespace Database\Seeders;

use App\Models\Jornada;
use Illuminate\Database\Seeder;

class JornadaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $registros = Jornada::count();

        if (!$registros) {

            $jornada = new Jornada();

            $jornada->id = 1;
            $jornada->nombre = "SIMPLE";
            $jornada->orden = 10;

            $jornada->save();
            
            $jornada = new Jornada();

            $jornada->id = 2;
            $jornada->nombre = "COMPLETA";
            $jornada->orden = 20;

            $jornada->save();

            $jornada = new Jornada();

            $jornada->id = 3;
            $jornada->nombre = "EXTENDIDA";
            $jornada->orden = 30;

            $jornada->save();
        }
            //
    }
}
