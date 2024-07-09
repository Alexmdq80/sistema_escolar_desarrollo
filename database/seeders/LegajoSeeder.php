<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Inscripcion;
use App\Models\Legajo;

class LegajoSeeder extends Seeder
{
    protected static int $id_persona;
    protected static $documento_persona;

    public static function set_id_persona(int $valor): void
    {
        self::$id_persona = $valor;
    }
    public static function get_id_persona(): int
    {
        return self::$id_persona;
    }
    public static function set_documento_persona($valor): void
    {
        self::$documento_persona = $valor;
    }
    public static function get_documento_persona()
    {
        return self::$documento_persona;
    }

    public function run(): void
    {
        $registros = Legajo::count();
        
        if (!$registros) {
            $inscripciones = Inscripcion::get(); 
            foreach ($inscripciones as $inscripcion) {
                
              self::set_id_persona($inscripcion->id_persona);
              self::set_documento_persona($inscripcion->persona->documento_numero);

              Legajo::factory(1)->create();
            }
        }
    }
}
