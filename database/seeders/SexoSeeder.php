<?php

namespace Database\Seeders;

use App\Models\Sexo;
use Illuminate\Database\Seeder;

class SexoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $registros = Sexo::count();

        if (!$registros) {
            
            $sexo = new Sexo();

            $sexo->id = 1;
            $sexo->nombre = "MASCULINO";
            $sexo->letra = "M";
            $sexo->orden = 10;
            $sexo->vigente = true;

            $sexo->save();

            $sexo = new Sexo();

            $sexo->id = 2;
            $sexo->nombre = "FEMENINO";
            $sexo->letra = "F";
            $sexo->orden = 20;
            $sexo->vigente = true;

            $sexo->save();

            $sexo = new Sexo();

            $sexo->id = 3;
            $sexo->nombre = "NO BINARIO";
            $sexo->letra = "X";
            $sexo->orden = 30;
            $sexo->vigente = true;

            $sexo->save();

            //

        }
    }
}
