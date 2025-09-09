<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\HistorialInfoInscripcion;
use App\Models\HistorialInscripcion;
use App\Models\Inscripcion;
use Illuminate\Support\Facades\DB;

class ActualizarInscripcionUuids extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'actualizar:historial-inscripcion-uuids';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Actualiza el UUID de HistorialInscripcion basado en condiciones específicas.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Iniciando la búsqueda y actualización de registros...');

        // 1. Buscar todos los registros en HistorialInfoInscripcion
        //    donde la causa de cierre sea '5'.
        $registrosInfo = HistorialInfoInscripcion::where('cierre_causa_id', 5)->get();

        if ($registrosInfo->isEmpty()) {
            $this->info('No se encontraron registros con cierre_causa_id = 5. Finalizando.');
            return Command::SUCCESS;
        }

        $this->info(count($registrosInfo) . ' registros encontrados. Procesando...');
        
        $registrosActualizados = 0;
        $registrosActualizadosEnHistorial = 0;
        $registrosNoActualizados = 0;

        // 2. Iterar sobre cada registro encontrado.
        foreach ($registrosInfo as $info) {
            DB::beginTransaction();
            try {
                // 3. Obtener el HistorialInscripcion relacionado.
                $historialInscripcion = $info->historialInscripcion()->first();

                // Si no existe, continuar con el siguiente registro.
                if (!$historialInscripcion) {
                    $this->warn("HistorialInscripcion no encontrado para HistorialInfoInscripcion ID: {$info->id}");
                    $registrosNoActualizados++;
                    DB::commit();
                    continue;
                }
                 $this->info("historialInscripcion '{$historialInscripcion->id}'");
                // 2. Acceder al valor de lectivo_id a través de las relaciones.
                //    Se verifica que todas las relaciones existan para evitar errores.
                if ($historialInscripcion->espacio && $historialInscripcion->espacio->propuesta && $historialInscripcion->espacio->propuesta->lectivo_id == 2) {
                    // 3. Usar persona_id para buscar el UUID principal en la tabla Inscripcion.
                    $inscripcionPrincipal = Inscripcion::where('persona_id', $historialInscripcion->persona_id)->first();

                    if ($inscripcionPrincipal) {
                        $uuidPrincipal = $inscripcionPrincipal->id;

                        // 4. Actualizar la columna 'uuid' en el registro de HistorialInscripcion.
                        $historialInscripcion->inscripcion_id = $uuidPrincipal;
                        $historialInscripcion->save();
                        
                        $registrosActualizados++;
                        $this->info("Registro de HistorialInscripcion '{$historialInscripcion->id}' actualizado con el UUID principal '{$uuidPrincipal}'.");
                    } else { 
                        $this->warn("Inscripcion principal no encontrada tampoco en historial para persona_id: {$historialInscripcion->persona_id}");
                        $registrosNoActualizados++;
                    }
                    
                } else if ($historialInscripcion->espacio && $historialInscripcion->espacio->propuesta && $historialInscripcion->espacio->propuesta->lectivo_id == 1) {
                    $this->warn("Inscripcion principal no encontrada para persona_id: {$historialInscripcion->persona_id}");
               //     $inscripcionPrincipalHistorial = HistorialInscripcion::where('persona_id', $historialInscripcion->persona_id)->first();
                    $inscripcionPrincipalHistorial = HistorialInscripcion::where('created_at', '<=', $historialInscripcion->created_at)
                        ->where('persona_id', $historialInscripcion->persona_id)
                        ->orderBy('created_at', 'desc')
                        ->first();

                    if ($inscripcionPrincipalHistorial) {
                            
                        $uuidPrincipalHistorial = $inscripcionPrincipalHistorial->inscripcion_id;
                        $historialInscripcion->uuid = $uuidPrincipalHistorial;
                        $historialInscripcion->save();

                        $registrosActualizadosEnHistorial++;
                    } else { 
                        $this->warn("Inscripcion principal no encontrada tampoco en historial para persona_id: {$historialInscripcion->persona_id}");
                        $registrosNoActualizados++;
                    }

                } else {
                    $this->info("Registro '{$historialInscripcion->id}' no cumple la condición de lectivo_id. Saltando...");
                    $registrosNoActualizados++;
                }


                DB::commit();
            } catch (\Exception $e) {
                DB::rollBack();
                $this->error("Error al procesar el registro {$info->id}: " . $e->getMessage());
                $registrosNoActualizados++;
            }
        }

        $this->info('Proceso finalizado.');
        $this->info("Registros actualizados: {$registrosActualizados}");
        $this->info("Registros actualizados en Historial: {$registrosActualizadosEnHistorial}");
        $this->info("Registros no actualizados: {$registrosNoActualizados}");

        return Command::SUCCESS;
    }
}
