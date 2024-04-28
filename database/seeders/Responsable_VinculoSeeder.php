<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Responsable_Vinculo;

class Responsable_VinculoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $registros = Responsable_Vinculo::count();

        if (!$registros) {
            
            $r_vinculo = new Responsable_Vinculo();

            $r_vinculo->id = 1;
            $r_vinculo->nombre = "PADRE";
            $r_vinculo->orden = 10;
            $r_vinculo->vigente = true;

            $r_vinculo->save();

            $r_vinculo = new Responsable_Vinculo();

            $r_vinculo->id = 2;
            $r_vinculo->nombre = "MADRE";
            $r_vinculo->orden = 20;
            $r_vinculo->vigente = true;

            $r_vinculo->save();

            $r_vinculo = new Responsable_Vinculo();

            $r_vinculo->id = 3;
            $r_vinculo->nombre = "TUTOR/A";
            $r_vinculo->orden = 30;
            $r_vinculo->vigente = true;

            $r_vinculo->save();

            $r_vinculo = new Responsable_Vinculo();

            $r_vinculo->id = 4;
            $r_vinculo->nombre = "OTRO/A";
            $r_vinculo->orden = 40;
            $r_vinculo->vigente = true;

            $r_vinculo->save();

            //

        }
    }
}
