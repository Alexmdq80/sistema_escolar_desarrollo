<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\HistorialInfoInscripcion;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class UuidHistorialCierrePase extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'actualizar:historial-uuid-cierre-pase';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Actualiza el UUID de HistorialInscripcion basado en la causa de cierre 2, copiando de la causa 1 previa o generando uno nuevo.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Iniciando la actualización de registros con cierre_causa_id = 2...');

        // 1. Obtener todos los registros con cierre_causa_id = 2 y sus relaciones
        $registrosInfo = HistorialInfoInscripcion::where('cierre_causa_id', 2)
                                                ->with(['historialInscripcion'])
                                                ->get();

        if ($registrosInfo->isEmpty()) {
            $this->info('No se encontraron registros con cierre_causa_id = 2. Finalizando.');
            return Command::SUCCESS;
        }

        $this->info(count($registrosInfo) . ' registros encontrados. Procesando...');

        $registrosActualizados = 0;
        $registrosNoActualizados = 0;

        foreach ($registrosInfo as $info) {
            DB::beginTransaction();
            try {
                $historialInscripcion = $info->historialInscripcion;

                if (!$historialInscripcion) {
                    $this->warn("HistorialInscripcion no encontrado para HistorialInfoInscripcion ID: {$info->id}.");
                    $registrosNoActualizados++;
                    DB::commit();
                    continue;
                }

                $previousUuid = null;

                // 2. Buscar el registro de HistorialInfoInscripcion previo con causa de cierre 1.
                //    Ahora con la condición de que debe ser del mismo persona_id.
                $registroPrevio = HistorialInfoInscripcion::where('cierre_causa_id', 1)
                    ->where('created_at', '<=', $info->created_at)
                    ->whereHas('historialInscripcion', function ($query) use ($historialInscripcion) {
                        $query->where('persona_id', $historialInscripcion->persona_id);
                    })
                    ->orderBy('created_at', 'desc')
                    ->first();

                if ($registroPrevio) {
                    // Cargar la relación para obtener el HistorialInscripcion
                    $historialPrevio = $registroPrevio->historialInscripcion()->first();

                    if ($historialPrevio) {
                        $previousUuid = $historialPrevio->inscripcion_id;
                        $this->info("Registro '{$info->id}' tiene un registro previo. Copiando UUID '{$previousUuid}'.");
                    }
                }

                // 3. Si no se encontró un UUID previo, generar uno nuevo.
                if (is_null($previousUuid)) {
                    $previousUuid = Str::uuid()->toString();
                    $this->info("No se encontró un registro previo con causa 1. Generando nuevo UUID: '{$previousUuid}'.");
                }

                // 4. Actualizar el campo 'uuid' del registro actual de HistorialInscripcion.
                $historialInscripcion->inscripcion_id = $previousUuid;
                $historialInscripcion->save();

                $registrosActualizados++;
                $this->info("UUID del registro '{$historialInscripcion->id}' actualizado a '{$previousUuid}'.");

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
