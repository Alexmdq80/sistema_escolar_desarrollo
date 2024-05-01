<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Persona;
use App\Models\Contacto;

class ContactoSeeder extends Seeder
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
        $registros = Contacto::count();
        
        if (!$registros) {
            $personas = Persona::get(); 
            foreach ($personas as $persona) {

              self::set_id_persona($persona->id);

              Contacto::factory(1)->create();
            }
        }
    }
}
