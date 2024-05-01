<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

use Database\Seeders\ContactoSeeder;
use App\Models\Contacto;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Contacto>
 */
class ContactoFactory extends Factory
{
    protected $model = Contacto::Class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $codigos = ["0223","011","0226"];

        $id_persona = ContactoSeeder::get_id_persona();
        $telefono_codigo_area = $this->faker->randomElement($codigos);
        $telefono = $this->faker->PhoneNumber();
        $celular_codigo_area = $this->faker->randomElement($codigos);
        $celular = $this->faker->PhoneNumber();
        $email = $this->faker->email();

        return [
            'id_persona' => $id_persona,
            'telefono_codigo_area' => $telefono_codigo_area,
            'telefono' => $telefono,
            'celular_codigo_area' => $celular_codigo_area,
            'celular' => $celular,
            'email' => $email
        ];
    }
}
