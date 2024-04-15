<?php

namespace Database\Seeders;

use App\Models\Dependencia;
use Illuminate\Database\Seeder;

class DependenciaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $registros = Dependencia::count();

        if (!$registros) {

            $dependencia = new Dependencia();

            $dependencia->id = 1;
            $dependencia->nombre = "OFICIAL";
            $dependencia->orden = 10;
            $dependencia->vigente = true;
            
            $dependencia->save();

            $dependencia = new Dependencia();

            $dependencia->id = 2;
            $dependencia->nombre = "MUNICIPAL";
            $dependencia->orden = 20;
            $dependencia->vigente = true;
            
            $dependencia->save();    

            $dependencia = new Dependencia();

            $dependencia->id = 3;
            $dependencia->nombre = "NACIONAL";
            $dependencia->orden = 30;
            $dependencia->vigente = true;
            
            $dependencia->save();   


            $dependencia = new Dependencia();

            $dependencia->id = 4;
            $dependencia->nombre = "PRIVADA";
            $dependencia->orden = 40;
            $dependencia->vigente = true;
            
            $dependencia->save();

            $dependencia = new Dependencia();

            $dependencia->id = 5;
            $dependencia->nombre = "OTROS";
            $dependencia->orden = 50;
            $dependencia->vigente = true;
            
            $dependencia->save(); 
        }
            //
    }
}
