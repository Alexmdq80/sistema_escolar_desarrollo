<?php

namespace Database\Seeders;

use App\Models\Genero;
use Illuminate\Database\Seeder;

class GeneroSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $registros = Genero::count();
    
        if (!$registros) {   
        //
            $genero = new Genero();

            $genero->id = 1;
            $genero->nombre = "MUJER";
            $genero->orden = 10;
            $genero->vigente = true;

            $genero->save();

            $genero = new Genero();

            $genero->id = 2;
            $genero->nombre = "VARÓN";
            $genero->orden = 20;
            $genero->vigente = true;

            $genero->save();

            $genero = new Genero();

            $genero->id = 3;
            $genero->nombre = "NO BINARIO";
            $genero->orden = 30;
            $genero->vigente = true;

            $genero->save();

            $genero = new Genero();

            $genero->id = 4;
            $genero->nombre = "MUJER TRANS/TRAVESTI";
            $genero->orden = 40;
            $genero->vigente = true;

            $genero->save();

            $genero = new Genero();

            $genero->id = 5;
            $genero->nombre = "VARÓN TRANS/MASCULINIDAD TRANS";
            $genero->orden = 50;
            $genero->vigente = true;

            $genero->save();

            $genero = new Genero();

            $genero->id = 6;
            $genero->nombre = "OTRA";
            $genero->orden = 60;
            $genero->vigente = true;

            $genero->save();

            $genero = new Genero();

            $genero->id = 7;
            $genero->nombre = "NO DESEA RESPONDER";
            $genero->orden = 70;
            $genero->vigente = true;

            $genero->save();
        }
    }
}
