<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Calle;
use App\Models\Domicilio;
use Database\Seeders\DomicilioSeeder;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Domicilio>
 */
class DomicilioFactory extends Factory
{
    protected $model = Domicilio::Class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $calles = new Calle();
        $id_calles = $calles->where('id_localidad_censal',246)
                            ->get(['id']);

        $id_persona = DomicilioSeeder::get_id_persona();
        $id_pais = 158;
        $id_provincia = 44;
        $id_departamento = 235;
        $id_localidad_asentamiento = 900;
        $codigo_postal = "7600";

        $id_calle = $this->faker->randomElement($id_calles);
        $id_calle_entre1 = $this->faker->randomElement($id_calles);
        $id_calle_entre2 = $this->faker->randomElement($id_calles);

        $numero = $this->faker->numberBetween($min = 0, $max = 9000);
        $piso =  $this->faker->numberBetween($min = 0, $max = 15);
        $torre = $this->faker->numberBetween($min = 0, $max = 4);
        $departamento = $this->faker->randomLetter();
        $otros = $this->faker->word();

        return [
                'id_persona' => $id_persona,
                'id_pais' => $id_pais,
                'id_provincia' => $id_provincia,
                'id_departamento' => $id_departamento,
                'id_localidad_asentamiento' => $id_localidad_asentamiento,
                'codigo_postal' => $codigo_postal,
                'id_calle' => $id_calle,
                'id_calle_entre1' => $id_calle_entre1,
                'id_calle_entre2' => $id_calle_entre2,
                'numero' => $numero,
                'piso' => $piso,
                'torre' => $torre,
                'departamento' => $departamento,
                'otros' => $otros   
        ];
    }
}
