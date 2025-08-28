<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ModalidadNivelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $dataToInsert = [
            ['modalidad_id' => 1, 'nivel_id' => 1, 'escuela_tipo_id' => null],
            ['modalidad_id' => 1, 'nivel_id' => 2, 'escuela_tipo_id' => null],
            ['modalidad_id' => 1, 'nivel_id' => 3, 'escuela_tipo_id' => 1],
            ['modalidad_id' => 1, 'nivel_id' => 4, 'escuela_tipo_id' => null],
            ['modalidad_id' => 2, 'nivel_id' => 3, 'escuela_tipo_id' => null],
            ['modalidad_id' => 2, 'nivel_id' => 4, 'escuela_tipo_id' => null],
            ['modalidad_id' => 4, 'nivel_id' => 1, 'escuela_tipo_id' => null],
            ['modalidad_id' => 4, 'nivel_id' => 2, 'escuela_tipo_id' => null],
            ['modalidad_id' => 4, 'nivel_id' => 3, 'escuela_tipo_id' => null],
            ['modalidad_id' => 5, 'nivel_id' => 1, 'escuela_tipo_id' => null],
            ['modalidad_id' => 5, 'nivel_id' => 2, 'escuela_tipo_id' => null],
            ['modalidad_id' => 9, 'nivel_id' => 1, 'escuela_tipo_id' => null],
            ['modalidad_id' => 9, 'nivel_id' => 2, 'escuela_tipo_id' => null],
            ['modalidad_id' => 9, 'nivel_id' => 3, 'escuela_tipo_id' => null],
        ];

        // Incluye timestamps si es necesario
        $now = now();
        $dataToInsert = array_map(function($item) use ($now) {
            $item['created_at'] = $now;
            $item['updated_at'] = $now;
            return $item;
        }, $dataToInsert);

        DB::table('modalidad_nivel')->insert($dataToInsert);
    }
}
