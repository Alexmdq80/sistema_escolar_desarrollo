<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class InicializarModalidadNivelCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'data:inicializar-modalidad-nivel';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Inserta los datos iniciales de la tabla modalidad_nivel.';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $this->info('Iniciando la inserción de datos en la tabla modalidad_nivel...');

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

        // Añade timestamps si es necesario
        $now = now();
        $dataToInsert = array_map(function($item) use ($now) {
            $item['created_at'] = $now;
            $item['updated_at'] = $now;
            return $item;
        }, $dataToInsert);

        DB::table('modalidad_nivel')->insert($dataToInsert);

        $this->info('Datos insertados exitosamente en la tabla modalidad_nivel. ✅');
    }
}