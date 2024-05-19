<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\Estudiante_Adulto_Vinculo;
use Database\Seeders\Estudiante_Adulto_VinculoSeeder;
use App\Models\Persona;
use App\Models\Inscripcion;
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
        $n_responsable = Estudiante_Adulto_VinculoSeeder::get_n_responsable();

        $id_vinculo= $this->faker->randomElement(Estudiante_Adulto_VinculoSeeder::get_id_vinculos());
     
        if ($id_vinculo < 5) {
            if ($n_responsable == 1){
            $adulto[1] = $this->faker->randomElement(Estudiante_Adulto_VinculoSeeder::get_adultos());
            } else {
            $adulto[1] = Estudiante_Adulto_VinculoSeeder::get_adulto_1();
            }         
            echo "ADULTO(1) = $adulto[1] \n";
            $id[1] = $adulto[1]->id;
        }

       
        $n = Estudiante_Adulto_VinculoSeeder::get_n_responsable();

        echo "Cantidad de responsables: $cant_adultosxvinculo \n"; 
        echo "Nro. de responsable: $n \n"; 

        if ($cant_adultosxvinculo == 1){
            $i = true;
        } else {
            $i = false;
        }
        if ($id_vinculo < 5) {
            while ($i == false){
                
                $adulto[2] = $this->faker->randomElement(Estudiante_Adulto_VinculoSeeder::get_adultos());
                echo "ADULTO(2) = $adulto[2] \n";
                $id[2] = $adulto[2]->id;
                
                echo "ID(1) = $id[1] ID(2) = $id[2] \n";
                if ($id[1] <> $id[2]) {
                    $i = true;
                }
            }      
            $id_adulto =  $id[$n];
            echo "ID_ADULTO_1: $id[1] \n";
            if ($i > 1){
            echo "ID_ADULTO_2: $id[2] \n";
            }
            echo "ID_ADULTO_RESPONSABLE = $id_adulto \n";
        }
        if ($id_vinculo > 4 && $id_vinculo < 9) {
            $adultos = Estudiante_Adulto_VinculoSeeder::get_adulto_1();
            $totales = count($adultos) - 2;
            $i = false;
            while ($i == false){
                $id = $this->faker->randomElement(Estudiante_Adulto_VinculoSeeder::get_adultos());
                $saltar = false;
                for ($n=0;$n<$totales;$n++) {
                //   if ($totales == 0){
                  if (is_array($adultos)){
                    $aux = $adultos;
                  } else {
                    $aux = $adultos[$n];
                  }
                  if ($id == $aux) {
                    $saltar = true;
                    $i = false;
                    break;
                  }                 
                }                
                if (!$saltar){$i = true;}
            }
            $id_adulto =  $id;
            echo "ID_ADULTO $id \n";
            echo "TOTALES $totales \n";
            echo "Valor N: $n \n";
        }
        if ($id_vinculo == 9) {
            $adultos = Estudiante_Adulto_VinculoSeeder::get_adulto_1();
            $totales = count($adultos) - 2;
            $i = false;
            while ($i == false){
                $id = $this->faker->randomElement(Estudiante_Adulto_VinculoSeeder::get_adultos());
                $saltar = false;
                for ($n=0;$n<$totales;$n++) {
                //   if ($totales == 0){
                  if (is_array($adultos)){
                    $aux = $adultos;
                  } else {
                    $aux = $adultos[$n];
                  }
                  if ($id == $aux) {
                    $saltar = true;
                    $i = false;
                    break;
                  }                 
                }                
                if (!$saltar){$i = true;}
            }
            $id_adulto =  $id;
            echo "ID_ADULTO $id \n";
            echo "TOTALES $totales \n";
            echo "Valor N: $n \n";
        }

        $id_inscripcion = Estudiante_Adulto_VinculoSeeder::get_id_inscripcion();
        echo "ID Inscripción: $id_inscripcion \n";
      
        return [
            'id_persona_estudiante'=>$id_estudiante,
            'id_persona_adulto'=>$id_adulto,
            'id_adulto_vinculo'=>$id_vinculo,
            'id_inscripcion'=>$id_inscripcion
        ]; 
    }
}
