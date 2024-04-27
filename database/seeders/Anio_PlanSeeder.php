<?php

namespace Database\Seeders;

use App\Models\Anio_Plan;
use App\Models\Plan_Estudio;
use Illuminate\Database\Seeder;

class Anio_PlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

      //  $registros = DB::select('select * from anio;');
        $registros = Anio_Plan::count();
        $planes = Plan_Estudio::get();

        if (!$registros) {
            foreach ($planes as $plan){
                $duracion = $plan->duracion_anios;

                for ($x = 1; $x <= $duracion; $x++) {
                    if ($duracion == 1){
                      $id_anio = 7;
                    } else {
                      if ($plan->id_ciclo_plan_estudio == 1) {
                        $id_anio = $x; 
                      } else {
                        $id_anio = $x + 3; 
                      } 
                    }
                    $anio = new Anio_Plan();
                    $anio->id_plan_estudio = $plan->id;
                    $anio->id_ciclo_plan_estudio = $plan->id_ciclo_plan_estudio;
                    $anio->id_anio = $id_anio;
                    $anio->save();
                }
            }

        }
    }
}
