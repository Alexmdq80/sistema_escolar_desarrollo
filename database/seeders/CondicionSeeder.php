<?php

namespace Database\Seeders;

use App\Models\Condicion;
use Illuminate\Database\Seeder;

class CondicionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $registros = Condicion::count();

        if (!$registros) {

            $condicion = new Condicion();

            $condicion->id = 1;
            $condicion->nombre = "INGRESANTE AL NIVEL";
            $condicion->orden = 10;
            $condicion->vigente = true;

            $condicion->save();
        
            $condicion = new Condicion();

            $condicion->id = 2;
            $condicion->nombre = "PROMOVIDO/A";
            $condicion->orden = 20;
            $condicion->vigente = true;

            $condicion->save();

            $condicion = new Condicion();

            $condicion->id = 3;
            $condicion->nombre = "REINSCRIPTO/A";
            $condicion->orden = 30;
            $condicion->vigente = true;

            $condicion->save();

            $condicion = new Condicion();

            $condicion->id = 4;
            $condicion->nombre = "REPITENTE";
            $condicion->orden = 40;
            $condicion->vigente = true;

            $condicion->save();

            $condicion = new Condicion();

            $condicion->id = 5;
            $condicion->nombre = "PROMOVIDO CON ÁREAS PENDIENTES";
            $condicion->orden = 50;
            $condicion->vigente = true;

            $condicion->save();
        }       
        //
    }
}
