<?php

namespace Database\Seeders;

use App\Models\Ambito;
use Illuminate\Database\Seeder;

class AmbitoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $registros = Ambito::count();

        if (!$registros) {

            $ambito = new Ambito();

            $ambito->id = "1";
            $ambito->nombre = "URBANO";
            $ambito->orden = 10;
            $ambito->vigente = true;
    
            $ambito->save();
            //
            $ambito2 = new Ambito();
            $ambito2->id = "2";
            $ambito2->nombre = "RURAL";
            $ambito2->orden = 20;
            $ambito2->vigente = true;
        
            $ambito2->save();
    
            $ambito3 = new Ambito();
            $ambito3->id = "3";
            $ambito3->nombre = "SIN INFORMACIÓN";
            $ambito3->orden = 30;
            $ambito3->vigente = true;
        
            $ambito3->save();
        }


   
        
    }

    //
}
