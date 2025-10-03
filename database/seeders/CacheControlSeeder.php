<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CacheControlSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('cache_control')->insert([
            'key' => 'last_persona_ref_update',
            'value' => now(), // Se inicializa con la fecha y hora actuales
            'descripcion' => 'Timestamp de la última modificación en las tablas de referencia asociadas al modelo Persona',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
