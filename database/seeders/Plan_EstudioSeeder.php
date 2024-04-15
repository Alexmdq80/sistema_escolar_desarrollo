<?php

namespace Database\Seeders;

use App\Models\Plan_Estudio;
use Illuminate\Database\Seeder;

class Plan_EstudioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $registros = Plan_Estudio::count();

        if (!$registros) {

            $plan_estudio = new Plan_Estudio();

            // $plan_estudio->id = 1;
            $plan_estudio->id_plan_ciclo = 1;
            $plan_estudio->nombre = "Bachiller Ciclo Básico";
            $plan_estudio->nombre_completo = '000- Sec. Estatal - Bachiller Ciclo Básico';
            $plan_estudio->duracion_anios = 3;
            $plan_estudio->resolucion = 'Resolución N° 302/12';
            $plan_estudio->orientacion = 'Ciclo Básico';
            $plan_estudio->save();

            $plan_estudio = new Plan_Estudio();

            // $plan_estudio->id = 2;
            $plan_estudio->id_plan_ciclo = 1;
            $plan_estudio->nombre = "Bachiller Ciclo Básico (Aulas de Aceleración)";
            $plan_estudio->nombre_completo = '000- Sec. Estatal - Bachiller Ciclo Básico (Aulas de Aceleración)';
            $plan_estudio->duracion_anios = 1;
            $plan_estudio->resolucion = 'Resolución N° 302/12';
            $plan_estudio->orientacion = 'Ciclo Básico';
            $plan_estudio->save();


            $plan_estudio = new Plan_Estudio();

            // $plan_estudio->id = 3;
            $plan_estudio->id_plan_ciclo = 2;
            $plan_estudio->nombre = "Bachiller en Ciencias Sociales";
            $plan_estudio->nombre_completo = '001- Sec. Estatal - Bachiller en Ciencias Sociales';
            $plan_estudio->duracion_anios = 3;
            $plan_estudio->resolucion = 'Resolución N° 302/12';
            $plan_estudio->orientacion = 'Ciencias Sociales';
            $plan_estudio->save();


            $plan_estudio = new Plan_Estudio();

            // $plan_estudio->id = 4;
            $plan_estudio->id_plan_ciclo = 2;
            $plan_estudio->nombre = "Bachiller en Ciencias Naturales";
            $plan_estudio->nombre_completo = '002- Sec. Estatal - Bachiller en Ciencias Naturales';
            $plan_estudio->duracion_anios = 3;
            $plan_estudio->resolucion = 'Resolución N° 302/12';
            $plan_estudio->orientacion = 'Ciencias Naturales';
            $plan_estudio->save();

            $plan_estudio = new Plan_Estudio();

            // $plan_estudio->id = 5;
            $plan_estudio->id_plan_ciclo = 2;
            $plan_estudio->nombre = "Bachiller en Economía y Administración";
            $plan_estudio->nombre_completo = '003- Sec. Estatal - Bachiller en Economía y Administración';
            $plan_estudio->duracion_anios = 3;
            $plan_estudio->resolucion = 'Resolución N° 302/12';
            $plan_estudio->orientacion = 'Economía y Administración';
            $plan_estudio->save();

            $plan_estudio = new Plan_Estudio();

            // $plan_estudio->id = 6;
            $plan_estudio->id_plan_ciclo = 2;
            $plan_estudio->nombre = "Bachiller en Turismo";
            $plan_estudio->nombre_completo = '172- Sec. Estatal - Bachiller en Turismo';
            $plan_estudio->duracion_anios = 3;
            $plan_estudio->resolucion = 'RESOLUCIÓN N°302/12- RESOLUCIÓN N°3124/19';
            $plan_estudio->orientacion = 'Turismo';
            $plan_estudio->save();
        }
        //
    }
}
