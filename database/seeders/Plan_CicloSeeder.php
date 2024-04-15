<?php

namespace Database\Seeders;

use App\Models\Plan_Ciclo;
use Illuminate\Database\Seeder;

class Plan_CicloSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //

        $registros = Plan_Ciclo::count();

        if (!$registros) {

            $ciclo = new Plan_Ciclo();

            $ciclo->id = 1;
            $ciclo->nombre = "CICLO BÁSICO";
            $ciclo->orden = 10;
            $ciclo->vigente = true;

            $ciclo->save();

            $ciclo = new Plan_Ciclo();

            $ciclo->id = 2;
            $ciclo->nombre = "CICLO SUPERIOR";
            $ciclo->orden = 10;
            $ciclo->vigente = true;

            $ciclo->save();
        //
        }

    }
}
