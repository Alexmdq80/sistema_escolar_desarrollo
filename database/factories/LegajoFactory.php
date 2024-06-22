<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Database\Seeders\LegajoSeeder;
use App\Models\Legajo;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Legajo>
 */
class LegajoFactory extends Factory
{
    protected $model = Legajo::Class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $id_persona = LegajoSeeder::get_id_persona();
        $libro =  $this->faker->numberBetween($min = 1, $max = 70);
        $folio =  $this->faker->numberBetween($min = 1, $max = 250);
        
        $legajo = LegajoSeeder::get_documento_persona();
        if (empty($legajo) || is_null($legajo))  {
            $legajo = null;
        } else {
            $legajo = substr($legajo, 2);
            // $legajo = intval($legajo);
        }


        return [
            'id_persona' => $id_persona,
            'libro' => $libro,
            'folio' => $folio,
            'legajo' => $legajo
        ];
    }
}
