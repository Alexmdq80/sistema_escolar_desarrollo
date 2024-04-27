<?php

namespace Database\Seeders;

use App\Models\Propuesta_Institucional;
use App\Models\Anio_Plan;
use App\Models\Plan_Estudio;
use App\Models\Turno;
use Illuminate\Database\Seeder;

class Propuesta_InstitucionalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $registros = Propuesta_Institucional::count();
        $turnos = new Turno();
        $anios_plan = Anio_Plan::get();
        if (!$registros) {
            foreach ($anios_plan as $anio) {
                if ($anio->id_anio == 7 or $anio->id_plan_estudio == 6){
                // A.F. TURNO VESPERTINO Y TURISMO VESPERTINO
                    $turno_id = 4;
                    $pi = new Propuesta_Institucional();
                    $pi->id_plan_estudio = $anio->id_plan_estudio;
                    $pi->id_ciclo_plan_estudio = $anio->id_ciclo_plan_estudio;
                    $pi->id_anio = $anio->id_anio;
                    $pi->id_anio_plan = $anio->id;
                    $pi->id_turno_inicio = $turno_id;
                    $pi->id_turno_fin = $turno_id;
                    $pi->id_jornada = 1;
                    $pi->id_ciclo_lectivo = 1;
                    $pi->save();   
                } else {
                    $turno_id = 1;
                    $pi = new Propuesta_Institucional();
                    $pi->id_plan_estudio = $anio->id_plan_estudio;
                    $pi->id_ciclo_plan_estudio = $anio->id_ciclo_plan_estudio;
                    $pi->id_anio = $anio->id_anio;
                    $pi->id_anio_plan = $anio->id;
                    $pi->id_turno_inicio = $turno_id;
                    $pi->id_turno_fin = $turno_id;
                    $pi->id_jornada = 1;
                    $pi->id_ciclo_lectivo = 1;
                    $pi->save();   
                    $turno_id = 2;
                    $pi = new Propuesta_Institucional();
                    $pi->id_plan_estudio = $anio->id_plan_estudio;
                    $pi->id_ciclo_plan_estudio = $anio->id_ciclo_plan_estudio;
                    $pi->id_anio = $anio->id_anio;
                    $pi->id_anio_plan = $anio->id;
                    $pi->id_turno_inicio = $turno_id;
                    $pi->id_turno_fin = $turno_id;
                    $pi->id_jornada = 1;
                    $pi->id_ciclo_lectivo = 1;
                    $pi->save();     
                } 
            }
        }

    }

}
