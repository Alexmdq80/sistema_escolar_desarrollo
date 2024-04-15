<?php

namespace Database\Seeders;

use App\Models\Escuela_PI;
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


            for ($x=1; $x <= 28; $x++){


                $E_PI = new Escuela_PI();

                $E_PI->id_escuela = 10109;
                $E_PI->id_propuesta_institucional = $x;

                $E_PI->save();
            }

        }
        //
    }
}
