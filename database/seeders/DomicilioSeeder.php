<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Persona;
use App\Models\Domicilio;

class DomicilioSeeder extends Seeder
{
    protected static int $id_persona;

    public static function set_id_persona(int $valor): void
    {
        self::$id_persona = $valor;
    }
    public static function get_id_persona(): int
    {
        return self::$id_persona;
    }

    public function run(): void
    {
        $registros = Domicilio::count();
        
        if (!$registros) {
            $personas = Persona::get(); 
            foreach ($personas as $persona) {

              self::set_id_persona($persona->id);

              Domicilio::factory(1)->create();
            }
        }
    }
   
}

