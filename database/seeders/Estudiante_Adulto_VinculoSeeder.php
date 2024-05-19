<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Inscripcion;
use App\Models\Persona;
use App\Models\Estudiante_Adulto_Vinculo;
use App\Models\Adulto_Vinculo;
use Carbon\Carbon;

class Estudiante_Adulto_VinculoSeeder extends Seeder
{

    protected static int $id_estudiante;
    protected static int $id_inscripcion;
    protected static int $cant_adultosxvinculo;
    protected static $adultos;
    protected static $id_vinculos;
    protected static int $n_responsable;
    protected static $adulto_1;
    protected static int $id_vinculo;
    protected static int $cant_autorizadas;

    public static function set_id_estudiante(int $valor): void
    {
        self::$id_estudiante = $valor;
    }
    public static function get_id_estudiante(): int
    {
        return self::$id_estudiante;
    }
    public static function set_id_inscripcion(int $valor): void
    {
        self::$id_inscripcion = $valor;
    }
    public static function get_id_inscripcion(): int
    {
        return self::$id_inscripcion;
    }
    public static function set_cant_adultosxvinculo(int $valor): void
    {
        self::$cant_adultosxvinculo = $valor;
    }
    public static function get_cant_adultosxvinculo(): int
    {
        return self::$cant_adultosxvinculo;
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
    public static function set_cant_autorizadas(int $valor): void
    {
        self::$cant_autorizadas = $valor;
    }
    public static function get_cant_autorizadas(): int
    {
        return self::$cant_autorizadas;
    }

    public function run(): void
    {
        $registros_inscripciones = Inscripcion::count();
        $registros_adultos = Estudiante_Adulto_Vinculo::count();
        
        echo "Inscripciones: $registros_inscripciones Personas_Responsables: $registros_adultos \n";
        if ($registros_inscripciones && !$registros_adultos) {

           $registros_adultos = Persona::where([
                ['nacimiento_fecha','<',Carbon::now()->subYears(21)]
                ])->get(); 
           
            // self::set_id_adultos($adultos->pluck('id'));
    
            self::set_adultos($registros_adultos);
            $c_adultos = count($registros_adultos);

            $inscripciones = Inscripcion::get();

            foreach($inscripciones as $inscripcion) {
                self::set_cant_adultosxvinculo(rand(1,2));
                self::set_id_estudiante($inscripcion->id_persona);
                self::set_id_inscripcion($inscripcion->id);
                $vinculos = Adulto_Vinculo::where('id_vinculo_tipo',1)->get();
                self::set_id_vinculos($vinculos->pluck('id')); 
                // RESPONSABLES //
                for ($i=1;$i <= self::get_cant_adultosxvinculo(); $i++){
                  if ($i == 2) {
                    // $id_adulto_1r = ne= Estudiante_Adulto_Vinculo;
                    $adulto_1EAV = new Estudiante_Adulto_Vinculo();
                    $adulto_1EAV = Estudiante_Adulto_Vinculo::where(
                                'id_persona_estudiante',$inscripcion->id_persona
                    )->get();  
                    echo "I: $i AdultoPR: $adulto_1EAV \n";
                    $id = $adulto_1EAV[0]->id_persona_adulto;
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

                  Estudiante_Adulto_Vinculo::factory(1)->create();
                }
                // AUTORIZADAS 
                self::set_cant_adultosxvinculo(rand(0,6));
                echo "Cantidad de adultos: $c_adultos \n";
                if (self::get_cant_adultosxvinculo() > 0) {
                    $vinculos = Adulto_Vinculo::where('id_vinculo_tipo',2)->get();
                    self::set_id_vinculos($vinculos->pluck('id')); 

                    for ($i=1;$i <= self::get_cant_adultosxvinculo(); $i++){
                      unset($adulto_1EAV);
                      $adulto_1EAV = new Estudiante_Adulto_Vinculo();
                      $adulto_1EAV = Estudiante_Adulto_Vinculo::where(
                                  'id_persona_estudiante',$inscripcion->id_persona
                                  )->get();  
                    //   echo "I: $i AdultoPR: $adulto_1EAV \n";
                    //   $id = $adulto_1EAV[0]->id_persona_adulto;
                    //   echo "ID ADULTO: $id \n";
                    //   $adulto_1A = Persona::where('id',$id)->get();    
                        
                    //   $adulto_1[$i] = new ;
                    //   $adulto_1[$i] = $adulto_1A[0];  
                        
                    //   echo "Adulto_1: $adulto_1 \n";
                
                       self::set_adulto_1($adulto_1EAV);
                    //   self::set_n_responsable($i);

                      Estudiante_Adulto_Vinculo::factory(1)->create();
                    }
                }
                // RESTRINGIDAS 
                self::set_cant_adultosxvinculo(rand(0,1));
                echo "Cantidad de adultos: $c_adultos \n";
                if (self::get_cant_adultosxvinculo() > 0) {
                    $vinculos = Adulto_Vinculo::where('id_vinculo_tipo',3)->get();
                    self::set_id_vinculos($vinculos->pluck('id')); 

                    for ($i=1;$i <= self::get_cant_adultosxvinculo(); $i++){
                      unset($adulto_1EAV);
                      $adulto_1EAV = new Estudiante_Adulto_Vinculo();
                      $adulto_1EAV = Estudiante_Adulto_Vinculo::where(
                                  'id_persona_estudiante',$inscripcion->id_persona
                                  )->get();  
                    //   echo "I: $i AdultoPR: $adulto_1EAV \n";
                    //   $id = $adulto_1EAV[0]->id_persona_adulto;
                    //   echo "ID ADULTO: $id \n";
                    //   $adulto_1A = Persona::where('id',$id)->get();    
                        
                    //   $adulto_1[$i] = new ;
                    //   $adulto_1[$i] = $adulto_1A[0];  
                        
                    //   echo "Adulto_1: $adulto_1 \n";
                
                       self::set_adulto_1($adulto_1EAV);
                    //   self::set_n_responsable($i);

                      Estudiante_Adulto_Vinculo::factory(1)->create();
                    }
                }
            }
        }
    }
}
