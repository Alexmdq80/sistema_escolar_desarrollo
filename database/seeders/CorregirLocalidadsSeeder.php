<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CorregirLocalidadsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // El array asocia el 'id' de la localidad con el 'localidad_censal_id' correcto.
        // Se usaría el nombre de las columnas o si es una corrección más compleja se podría usar el nombre de las columnas.
        $updates = [
            // id de la localidad => localidad_censal_id correcto
            6110  => 1555, // Colonia Argentina -> Colonia La Argentina
            13899 => 1532, // Osvaldo Magnasco
            10339 => 2719, // Alto de Sierra
            14078 => 2235, // Expansión de Posadas
        ];

        foreach ($updates as $localidadId => $localidadCensalId) {
            DB::table('localidads')
                ->where('id', $localidadId)
                ->update(['localidad_censal_id' => $localidadCensalId]);
        }

        $this->command->info('Localidades corregidas exitosamente.');
    }
}
