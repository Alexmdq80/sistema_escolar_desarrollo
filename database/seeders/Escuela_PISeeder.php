<?php

namespace Database\Seeders;

use App\Models\Escuela_PI;
use App\Models\Propuesta_Institucional;
use Illuminate\Database\Seeder;

class Escuela_PISeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $registros = Escuela_PI::count();

        if (!$registros) {

            $propuestas_institucionales = Propuesta_Institucional::get();
            foreach ($propuestas_institucionales as $pi){
            // for ($x=1; $x <= 56; $x++){


                $E_PI = new Escuela_PI();

                $E_PI->id_escuela = 10109;
                $E_PI->id_propuesta_institucional = $pi->id;

                $E_PI->save();
            }

        }
        //
    }
}
