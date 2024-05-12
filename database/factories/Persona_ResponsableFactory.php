<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\Persona_Responsable;
use Database\Seeders\Persona_ResponsableSeeder;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Persona_Responsable>
 */
class Persona_ResponsableFactory extends Factory
{
    protected $model = Persona_Responsable::Class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $id_estudiante = Persona_ResponsableSeeder::get_id_estudiante();

        $cant_responsables = Persona_ResponsableSeeder::get_cant_responsables();
        $n_responsable = Persona_ResponsableSeeder::get_n_responsable();

        if ($n_responsable == 1){
          $adulto[1] = $this->faker->randomElement(Persona_ResponsableSeeder::get_adultos());
        } else {
          $adulto[1] = Persona_ResponsableSeeder::get_adulto_1();
        }         
        echo "ADULTO(1) = $adulto[1] \n";
        $id[1] = $adulto[1]->id;

        $id_vinculo= $this->faker->randomElement(Persona_ResponsableSeeder::get_id_vinculos());
       
        $n = Persona_ResponsableSeeder::get_n_responsable();

        echo "Cantidad de responsables: $cant_responsables \n"; 
        echo "Nro. de responsable: $n \n"; 

        if ($cant_responsables == 1){
            $i = true;
        } else {
            $i = false;
        }
        while ($i == false){
            
            $adulto[2] = $this->faker->randomElement(Persona_ResponsableSeeder::get_adultos());
            echo "ADULTO(2) = $adulto[2] \n";
            $id[2] = $adulto[2]->id;
            
            echo "ID(1) = $id[1] ID(2) = $id[2] \n";
            if ($id[1] <> $id[2]) {
                $i = true;
            }
            
        }      

        $id_adulto_responsable =  $id[$n];
        
        echo "ID_ADULTO_1: $id[1] \n";
        if ($i > 1){
          echo "ID_ADULTO_2: $id[2] \n";
        }
        echo "ID_ADULTO_RESPONSABLE = $id_adulto_responsable \n";


        return [
            'id_persona_estudiante'=>$id_estudiante,
            'id_persona_responsable'=>$id_adulto_responsable,
            'id_responsable_vinculo'=>$id_vinculo,
        ]; 
    }
}
