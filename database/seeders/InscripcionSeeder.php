<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Inscripcion;
use App\Models\Persona;

class InscripcionSeeder extends Seeder
{
    protected static int $id_persona;
    protected static $años;
    protected static int $año;

    public static function set_id_persona(int $valor): void
    {
        self::$id_persona = $valor;
    }
    public static function get_id_persona(): int
    {
        return self::$id_persona;
    }
    public static function set_años($valor): void
    {
        self::$años = $valor;
    }
    public static function get_años()
    {
        return self::$años;
    }
    public static function set_año(int $valor): void
    {
        self::$año = $valor;
    }
    public static function get_año(): int
    {
        return self::$año;
    }

    public function run(): void
    {
        $registros = Inscripcion::count();
        
        if (!$registros) {


            // 10-11 años 
            $personas = Persona::where([
                                        ['nacimiento_fecha','>','2013-01-01'],
                                        ['nacimiento_fecha','<','2014-01-01'],
                                        ])->get(); 
           
            foreach ($personas as $persona) {

                self::set_id_persona($persona->id);
                self::set_años([1,2,3,4]);
                self::set_año(1);

                Inscripcion::factory(1)->create();
            }


        }
    }
}
