<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\Estudiante_Adulto_Vinculo;
use Database\Seeders\Estudiante_Adulto_VinculoSeeder;
use App\Models\Persona;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Estudiante_Adulto_Vinculo>
 */
class Estudiante_Adulto_VinculoFactory extends Factory
{
    protected $model = Estudiante_Adulto_Vinculo::Class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $id_estudiante = Estudiante_Adulto_VinculoSeeder::get_id_estudiante();
        $cant_adultosxvinculo = Estudiante_Adulto_VinculoSeeder::get_cant_adultosxvinculo();
        $id_vinculo= $this->faker->randomElement(Estudiante_Adulto_VinculoSeeder::get_id_vinculos());
        echo "ID_ESTUDIANTE: $id_estudiante \n";
        echo "ID_VINCULO $id_vinculo \n";
        echo "Cantidad de adultos x vínculo: $cant_adultosxvinculo \n"; 

        $id_adultos_estudiante = Estudiante_Adulto_VinculoSeeder::get_id_adultos_estudiante();
        // $totales = count($adultos) - 2;
        echo "ID_ADULTOS_ESTUDIANTE: $id_adultos_estudiante \n";
        $id_adultos_estudiante = $id_adultos_estudiante->toArray();
        // var_dump($id_adultos_estudiante);
        if ($id_vinculo == 9) {
          $detalle = $this->faker->text(); 
          $fecha = $this->faker->dateTimeBetween($startDate = '-4 years', $endDate = '+2 years', $timezone = null);
        } else {
          $detalle =  null;
          $fecha = null;
        }
        if (is_array($id_adultos_estudiante)){
          echo "id_adultos_estudiante es un array";
          $totales = count($id_adultos_estudiante);
        } elseif (is_null($id_adultos_estudiante) || empty($id_adultos_estudiante)) {
          echo "id_adultos_estudiante está en null o está empty";
          $totales = 0;
        } else {
          echo "id_adultos_estudiante no es un array ";
          $totales = 1;
        }
        if ($totales == 0){
          $id = $this->faker->randomElement(Estudiante_Adulto_VinculoSeeder::get_adultos());
        } else {
          $i = false;
          while ($i == false){
              $id = $this->faker->randomElement(Estudiante_Adulto_VinculoSeeder::get_adultos());
              $saltar = false;
              for ($n=0;$n<$totales;$n++) {
                if (is_array($id_adultos_estudiante)){
                  $aux = $id_adultos_estudiante[$n];
                } else {
                  $aux = $id_adultos_estudiante;
                }
                if ($id == $aux) {
                  $saltar = true;
                  $i = false;
                  break;
                }                 
              }                
              if (!$saltar){$i = true;}
          }
        }

        $id_adulto =  $id;
        echo "ID_ADULTO $id \n";
        echo "TOTALES $totales \n";
             
        return [
            'id_persona_estudiante'=>$id_estudiante,
            'id_persona_adulto'=>$id_adulto,
            'id_adulto_vinculo'=>$id_vinculo,
            'detalle'=>$detalle,
            'vencimiento_fecha'=>$fecha
        ]; 
    }
}
