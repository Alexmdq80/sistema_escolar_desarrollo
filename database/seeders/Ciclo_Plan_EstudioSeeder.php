<?php

namespace Database\Seeders;

use App\Models\Ciclo_Plan_Estudio;
use Illuminate\Database\Seeder;

class ciclo_plan_estudioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //

        $registros = ciclo_plan_estudio::count();

        if (!$registros) {

            $ciclo = new ciclo_plan_estudio();

            $ciclo->id = 1;
            $ciclo->nombre = "CICLO BÁSICO";
            $ciclo->orden = 10;
            $ciclo->vigente = true;

            $ciclo->save();

            $ciclo = new ciclo_plan_estudio();

            $ciclo->id = 2;
            $ciclo->nombre = "CICLO SUPERIOR";
            $ciclo->orden = 10;
            $ciclo->vigente = true;

            $ciclo->save();
        //
        }

    }
}
