<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Persona;
use App\Models\Estudiante_Adulto_Vinculo;
use App\Models\Adulto_Vinculo;
use Carbon\Carbon;

class Estudiante_Adulto_VinculoSeeder extends Seeder
{

    protected static $adultos;
    protected static $id_vinculos;
    protected static $id_adultos_estudiante;
    protected static int $id_estudiante;
    protected static int $cant_adultosxvinculo;


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
    public static function set_id_adultos_estudiante($valor): void
    {
        self::$id_adultos_estudiante = $valor;
    }
    public static function get_id_adultos_estudiante()
    {
        return self::$id_adultos_estudiante;
    }
    public static function set_id_estudiante(int $valor): void
    {
        self::$id_estudiante = $valor;
    }
    public static function get_id_estudiante(): int
    {
        return self::$id_estudiante;
    }
    public static function set_cant_adultosxvinculo(int $valor): void
    {
        self::$cant_adultosxvinculo = $valor;
    }
    public static function get_cant_adultosxvinculo(): int
    {
        return self::$cant_adultosxvinculo;
    }

    public function run(): void
    {
        $EAV = Estudiante_Adulto_Vinculo::count();        
        // echo "Cantidad de registros en EAV: $EAV \n";

        if (!$EAV) {

            // Cargo los id's adultos cuya fecha de nacimiento sea menor a la actual menos 21 años
           $registros_adultos = Persona::where([
                ['nacimiento_fecha','<',Carbon::now()->subYears(21)]
                ])->get('id'); 
           
            $id_adultos = $registros_adultos->pluck('id');            
            self::set_adultos($id_adultos);
         
            // Cargo los id's de los menores cuya fecha de nacimiento sea mayor a la actual menos 21 años
            $registros_menores = Persona::where([
                ['nacimiento_fecha','>',Carbon::now()->subYears(21)]
                ])->get('id'); 

            $id_menores = $registros_menores->pluck('id');
            foreach($id_menores as $id_menor) {
                for ($y = 1;$y <=3; $y++) {
                    echo "Valor de Y $y \n";
                    switch ($y){
                      case 1:
                         $z = rand(1,2);
                         $vinculos = Adulto_Vinculo::where('id_vinculo_tipo',1)->get('id');
                         echo "Responsables.... \n";
                         break;
                      case 2:
                         $z = rand(0,6);
                         $vinculos = Adulto_Vinculo::where('id_vinculo_tipo',2)->get('id');
                         echo "Autorizadas.... \n";
                         break;
                      case 3:
                         $z = rand(0,1);
                         $vinculos = Adulto_Vinculo::where('id_vinculo_tipo',3)->get('id');
                         echo "Restringidas.... \n";
                         break;
                    };
                    self::set_cant_adultosxvinculo($z);
                    self::set_id_estudiante($id_menor);
                    $idvinculos = $vinculos->pluck('id');
                    self::set_id_vinculos($idvinculos); 

                    if ($z > 0){
                        for ($i=1;$i <= $z; $i++){
                            echo "Valor de I: $i sobre Z: $z \n";
                            $adultosxestudiante = Estudiante_Adulto_Vinculo::where(
                                                    'id_persona_estudiante',$id_menor)
                                                    ->get('id_persona_adulto');  

                            $id_adultosxestudiante = $adultosxestudiante->pluck('id_persona_adulto');
                            self::set_id_adultos_estudiante($id_adultosxestudiante);
                            Estudiante_Adulto_Vinculo::factory(1)->create();
                        }
                    }
                }                        
              
            }
        }
    }
}
