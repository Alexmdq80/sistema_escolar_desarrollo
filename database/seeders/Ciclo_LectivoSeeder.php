<?php

namespace Database\Seeders;

use App\Models\Ciclo_Lectivo;
use Illuminate\Database\Seeder;

class Ciclo_LectivoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $registros = Ciclo_Lectivo::count();

        if (!$registros) {

            $ciclo = new Ciclo_Lectivo();

            $ciclo->id = 1;
            $ciclo->nombre = 2024;
            $ciclo->orden = 10;
            $ciclo->vigente = true;

            $ciclo->save();
        //
        }
    }
}
