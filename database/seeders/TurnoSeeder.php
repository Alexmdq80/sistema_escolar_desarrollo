<?php

namespace Database\Seeders;

use App\Models\Turno;
use Illuminate\Database\Seeder;

class TurnoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $registros = Turno::count();

        if (!$registros) {

            $turno = new Turno();

            $turno->id = 1;
            $turno->nombre = "MAÑANA";
            $turno->orden = 10;

            $turno->save();

            $turno = new Turno();

            $turno->id = 2;
            $turno->nombre = "TARDE";
            $turno->orden = 20;

            $turno->save();

            $turno = new Turno();

            $turno->id = 3;
            $turno->nombre = "NOCHE";
            $turno->orden = 30;

            $turno->save();

            $turno = new Turno();

            $turno->id = 4;
            $turno->nombre = "VERSPERTINO";
            $turno->orden = 40;

            $turno->save();
        }
        //
    }
}
