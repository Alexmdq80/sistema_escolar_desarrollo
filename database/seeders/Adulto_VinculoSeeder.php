<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Adulto_Vinculo;

class Adulto_VinculoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $registros = Adulto_Vinculo::count();

        if (!$registros) {
            
            $av = new Adulto_Vinculo();

            $av->id = 1;
            $av->id_vinculo_tipo = 1;
            $av->nombre = "PADRE";
            $av->orden = 10;
            $av->vigente = true;

            $av->save();

            $av = new Adulto_Vinculo();

            $av->id = 2;
            $av->id_vinculo_tipo = 1;
            $av->nombre = "MADRE";
            $av->orden = 15;
            $av->vigente = true;

            $av->save();

            $av = new Adulto_Vinculo();

            $av->id = 3;
            $av->id_vinculo_tipo = 1;
            $av->nombre = "TUTOR/A";
            $av->orden = 20;
            $av->vigente = true;

            $av->save();

            $av = new Adulto_Vinculo();

            $av->id = 4;
            $av->id_vinculo_tipo = 1;
            $av->nombre = "OTRO/A";
            $av->orden = 25;
            $av->vigente = true;

            $av->save();

            $av = new Adulto_Vinculo();

            $av->id = 5;
            $av->id_vinculo_tipo = 2;
            $av->nombre = "ABUELO/ABUELA";
            $av->orden = 30;
            $av->vigente = true;

            $av->save();

            $av = new Adulto_Vinculo();

            $av->id = 6;
            $av->id_vinculo_tipo = 2;
            $av->nombre = "TÍO/TÍA";
            $av->orden = 35;
            $av->vigente = true;

            $av->save();

            $av = new Adulto_Vinculo();

            $av->id = 7;
            $av->id_vinculo_tipo = 2;
            $av->nombre = "HERMANO/HERMANA";
            $av->orden = 40;
            $av->vigente = true;

            $av->save();

            $av = new Adulto_Vinculo();

            $av->id = 8;
            $av->id_vinculo_tipo = 2;
            $av->nombre = "VECINO/VECINA";
            $av->orden = 45;
            $av->vigente = true;

            $av->save();

            $av = new Adulto_Vinculo();

            $av->id = 9;
            $av->id_vinculo_tipo = 3;
            $av->nombre = "ACERCAMIENTO";
            $av->orden = 50;
            $av->vigente = true;

            $av->save();

            //

        }
    }
}
