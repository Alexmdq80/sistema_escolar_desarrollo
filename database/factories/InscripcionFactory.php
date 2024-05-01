<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Inscripcion;
use Database\Seeders\InscripcionSeeder;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Inscripcion>
 */
class InscripcionFactory extends Factory
{

    protected $model = Inscripcion::Class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        
        $años = InscripcionSeeder::get_años();
        $año = InscripcionSeeder::get_año();
        
        $id_persona = InscripcionSeeder::get_id_persona();
        $id_persona_firma = null;
        $id_espacio_academico = $this->faker->randomElement($años);
        $id_escuela_procedencia = null;
        $id_escuela_destino = 10109;
        
        if ($año == 1) {
          $id_nivel_procedencia = 2;
          $id_condicion = 1;
        }
        
        $id_modalidad_procedencia = 1;
        $codigo_abc = $this->faker->regexify();
        $proyecto_inclusion_si = 0;
        $concurre_especial_si = 0;
        $asistente_externo_si = 0;

        return [
                'id_persona' => $id_persona,
                'id_persona_firma' => $id_persona_firma,
                'id_espacio_academico' => $id_espacio_academico,
                'id_escuela_procedencia' => $id_escuela_procedencia,
                'id_escuela_destino' => $id_escuela_destino,
                'id_nivel_procedencia' => $id_nivel_procedencia,
                'id_modalidad_procedencia' => $id_modalidad_procedencia,
                'codigo_abc' => $codigo_abc,
                'id_condicion' => $id_condicion,
                'proyecto_inclusion_si' => $proyecto_inclusion_si,
                'concurre_especial_si' => $concurre_especial_si,
                'asistente_externo_si' => $asistente_externo_si            
        ];
    }
}
