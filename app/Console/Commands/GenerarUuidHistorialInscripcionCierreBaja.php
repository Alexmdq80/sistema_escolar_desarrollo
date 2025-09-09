<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;
use App\Models\HistorialInfoInscripcion;
use App\Models\HistorialInscripcion;
use Illuminate\Support\Facades\DB;

class GenerarHistorialUuidCierreBaja extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generar:historial-uuid-cierre-baja';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Genera un UUID para los registros de HistorialInscripcion con cierre_causa_id = 3.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Iniciando la generación de UUIDs...');

        // 1. Buscar todos los registros en HistorialInfoInscripcion
        //    donde la causa de cierre sea '3'.
        $registrosInfo = HistorialInfoInscripcion::where('cierre_causa_id', 3)->get();

        if ($registrosInfo->isEmpty()) {
            $this->info('No se encontraron registros con cierre_causa_id = 3. Finalizando.');
            return Command::SUCCESS;
        }

        $this->info(count($registrosInfo) . ' registros encontrados. Procesando...');
        
        $registrosActualizados = 0;
        $registrosNoActualizados = 0;

        foreach ($registrosInfo as $info) {
            DB::beginTransaction();
            try {
                // 2. Obtener el HistorialInscripcion relacionado.
                $historialInscripcion = $info->historialInscripcion()->first();

                if (!$historialInscripcion) {
                    $this->warn("HistorialInscripcion no encontrado para HistorialInfoInscripcion ID: {$info->id}");
                    $registrosNoActualizados++;
                    DB::commit();
                    continue;
                }

                // 3. Generar un nuevo UUID.
                $newUuid = Str::uuid()->toString();

                // 4. Actualizar el campo 'uuid' del HistorialInscripcion.
                $historialInscripcion->inscripcion_id = $newUuid;
                $historialInscripcion->save();
                
                $registrosActualizados++;
                $this->info("UUID generado para el registro '{$historialInscripcion->id}': '{$newUuid}'.");

                DB::commit();
            } catch (\Exception $e) {
                DB::rollBack();
                $this->error("Error al procesar el registro {$info->id}: " . $e->getMessage());
                $registrosNoActualizados++;
            }
        }

        $this->info('Proceso finalizado.');
        $this->info("Registros actualizados: {$registrosActualizados}");
        $this->info("Registros no actualizados: {$registrosNoActualizados}");

        return Command::SUCCESS;
    }
}
