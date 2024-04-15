<?php

namespace Database\Seeders;

use App\Models\Seccion_Tipo;
use Illuminate\Database\Seeder;

class Seccion_TipoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $registros = Seccion_Tipo::count();

        if (!$registros) {

            $seccion = new Seccion_Tipo();

            $seccion->id = 1;
            $seccion->nombre = 'SIMPLE';
            $seccion->orden = 10;
            
            $seccion->save();

            $seccion = new Seccion_Tipo();

            $seccion->id = 2;
            $seccion->nombre = 'MÚLTIPLE';
            $seccion->orden = 10;
            
            $seccion->save();
        }
        //
    }
}
