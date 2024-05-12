<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Inscripcion;
use App\Models\Persona;
use App\Models\Persona_Responsable;
use App\Models\Responsable_Vinculo;
use Carbon\Carbon;

class Persona_ResponsableSeeder extends Seeder
{

    protected static int $id_estudiante;
    protected static int $cant_responsables;
    protected static $adultos;
    protected static $id_vinculos;
    protected static int $n_responsable;
    protected static $adulto_1;

    public static function set_id_estudiante(int $valor): void
    {
        self::$id_estudiante = $valor;
    }
    public static function get_id_estudiante(): int
    {
        return self::$id_estudiante;
    }
    public static function set_cant_responsables(int $valor): void
    {
        self::$cant_responsables = $valor;
    }
    public static function get_cant_responsables(): int
    {
        return self::$cant_responsables;
    }
    public static function set_adultos($valor): void
    {
        self::$adultos = $valor;
    }
    public static function get_adultos()
    {
        return self::$adultos;
    }
    public static function set_id_vinculos($valor): void
    {
        self::$id_vinculos = $valor;
    }
    public static function get_id_vinculos()
    {
        return self::$id_vinculos;
    }
    public static function set_n_responsable(int $valor): void
    {
        self::$n_responsable = $valor;
    }
    public static function get_n_responsable(): int
    {
        return self::$n_responsable;
    }
    public static function set_adulto_1($valor): void
    {
        self::$adulto_1 = $valor;
    }
    public static function get_adulto_1()
    {
        return self::$adulto_1;
    }

    public function run(): void
    {
        $registros_inscripciones = Inscripcion::count();
        $registros_personas_responsables = Persona_Responsable::count();
        
        echo "Inscripciones: $registros_inscripciones Personas_Responsables: $registros_personas_responsables \n";
        if ($registros_inscripciones && !$registros_personas_responsables) {
            $vinculos = Responsable_Vinculo::get();
            self::set_id_vinculos($vinculos->pluck('id')); 

            $registros_adultos = Persona::where([
                ['nacimiento_fecha','<',Carbon::now()->subYears(21)]
                ])->get(); 
           
            // self::set_id_adultos($adultos->pluck('id'));
    
            self::set_adultos($registros_adultos);
    
            $inscripciones = Inscripcion::get();

            foreach($inscripciones as $inscripcion) {
                self::set_cant_responsables(rand(1,2));
                self::set_id_estudiante($inscripcion->id_persona);
                
                for ($i=1;$i <= self::get_cant_responsables(); $i++){
                  if ($i == 2) {
                    // $id_adulto_1r = new Persona_Responsable;
                    $adulto_1PR = new Persona_Responsable();
                    $adulto_1PR = Persona_Responsable::where(
                                'id_persona_estudiante',$inscripcion->id_persona
                    )->get();  
                    echo "I: $i AdultoPR: $adulto_1PR \n";
                    $id = $adulto_1PR[0]->id_persona_responsable;
                    echo "ID ADULTO_1: $id \n";
                    $adulto_1A = Persona::where('id',$id)->get();    
                    
                    $adulto_1 = new Persona;
                    $adulto_1 = $adulto_1A[0];    
                    echo "Adulto_1: $adulto_1 \n";
                  
                  } else {
                    $adulto_1 = new Persona;
                    $adulto_1->id = 0;
                  }
                  self::set_adulto_1($adulto_1);
                  self::set_n_responsable($i);
                  Persona_Responsable::factory(1)->create();
                }
            }
        }
    }
}
