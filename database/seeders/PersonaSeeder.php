<?php

namespace Database\Seeders;

use App\Models\Persona;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class PersonaSeeder extends Seeder
{
    // protected $model = Persona::Class;
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $personas = Persona::get();
        $faker = Faker::create();
        foreach ($personas as $persona) {
            $persona->apellido = mb_strtoupper($faker->lastname());
            $persona->nombre = mb_strtoupper($faker->name());

            $persona->save();
        }
    }
}
