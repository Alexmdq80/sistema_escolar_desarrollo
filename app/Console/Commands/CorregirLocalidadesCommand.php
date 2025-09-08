<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class CorregirLocalidadesCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'data:corregir-localidades';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Corrige los IDs de las localidades según una lista predefinida.';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        // El array asocia el 'id' de la localidad con el 'localidad_censal_id' correcto.
        $updates = [
            // id de la localidad => localidad_censal_id correcto
            6110  => 1555, // Colonia Argentina -> Colonia La Argentina
            13899 => 1532, // Osvaldo Magnasco
            10339 => 2719, // Alto de Sierra
            14078 => 2235, // Expansión de Posadas
        ];

        $this->info('Iniciando la corrección de localidades...');

        foreach ($updates as $localidadId => $localidadCensalId) {
            DB::table('localidads')
                ->where('id', $localidadId)
                ->update(['localidad_censal_id' => $localidadCensalId]);

            $this->comment("Localidad con ID {$localidadId} corregida a localidad_censal_id {$localidadCensalId}.");
        }

        $this->info('Corrección de localidades finalizada exitosamente. ✅');
    }
}