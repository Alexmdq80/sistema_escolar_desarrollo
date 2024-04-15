<?php

namespace Database\Seeders;

use App\Models\Nivel;
use Illuminate\Database\Seeder;

class NivelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $registros = Nivel::count();

        if (!$registros) {
            
            $nivel = new Nivel();

            $nivel->id = 1;
            $nivel->nombre = "INICIAL";
            $nivel->orden = 10;
            $nivel->vigente = true;

            $nivel->save();

            $nivel = new Nivel();

            $nivel->id = 2;
            $nivel->nombre = "PRIMARIA";
            $nivel->orden = 20;
            $nivel->vigente = true;

            $nivel->save();

            $nivel = new Nivel();

            $nivel->id = 3;
            $nivel->nombre = "SECUNDARIA";
            $nivel->orden = 30;
            $nivel->vigente = true;

            $nivel->save();

            $nivel = new Nivel();

            $nivel->id = 4;
            $nivel->nombre = "SUPERIOR";
            $nivel->orden = 40;
            $nivel->vigente = true;

            $nivel->save();
        }
        //
    }
}
