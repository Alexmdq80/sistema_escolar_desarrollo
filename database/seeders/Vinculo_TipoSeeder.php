<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Vinculo_Tipo;

class Vinculo_TipoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $registros = Vinculo_Tipo::count();

        if (!$registros) {

            $vt = new Vinculo_Tipo();

            $vt->id = 1;
            $vt->nombre = "RESPONSABLE";
            $vt->orden = 10;
            $vt->vigente = true;

            $vt->save();

            $vt = new Vinculo_Tipo();

            $vt->id = 2;
            $vt->nombre = "AUTORIZADA";
            $vt->orden = 20;
            $vt->vigente = true;

            $vt->save();

            $vt = new Vinculo_Tipo();

            $vt->id = 3;
            $vt->nombre = "RESTRINGIDA";
            $vt->orden = 30;
            $vt->vigente = true;

            $vt->save();        
         
        }       
        //
    }
}
