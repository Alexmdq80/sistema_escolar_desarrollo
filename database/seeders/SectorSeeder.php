<?php

namespace Database\Seeders;

use App\Models\Sector;
use Illuminate\Database\Seeder;

class SectorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $registros = Sector::count();

        if (!$registros) {

            $sector = new Sector();

            $sector->id = 1;
            $sector->nombre = 'ESTATAL';
            $sector->orden = 10;
            $sector->vigente = true;

            $sector->save();

            $sector = new Sector();

            $sector->id = 2;
            $sector->nombre = 'PRIVADO';
            $sector->orden = 20;
            $sector->vigente = true;

            $sector->save();

            $sector = new Sector();

            $sector->id = 3;
            $sector->nombre = 'SOCIAL/COOPERATIVA';
            $sector->orden = 30;
            $sector->vigente = true;

            $sector->save();
        }
            //
    }
}
