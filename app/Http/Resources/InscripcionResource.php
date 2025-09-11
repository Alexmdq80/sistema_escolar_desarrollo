<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Inscripcion;

class InscripcionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {

        return [
                // Datos de la inscripción
                'inscripcion_id' => $this->id,
                'fecha_inscripcion' => $this->fecha,

                // Datos del estudiante y su documento
                'estudiante_nombre' => $this->whenLoaded('persona', fn() => $this->persona->nombre),
                'estudiante_apellido' => $this->whenLoaded('persona', fn() => $this->persona->apellido),
                'documento_numero' => $this->whenLoaded('persona', fn() => $this->persona->documento_numero),

                'documento_tipo' => $this->whenLoaded('persona', function () {
                    // Usa el operador ?-> para acceder de forma segura
                    return $this->persona->documentoTipo?->nombre;
                }),

                // Datos del espacio (división)
                'division_nombre' => $this->whenLoaded('espacio', fn() => $this->espacio?->division_nombre),
                'division_numero' => $this->whenLoaded('espacio', fn() => $this->espacio?->division),

                // Datos del plan de estudio
                'plan_nombre' => $this->whenLoaded('espacio', fn() => $this->espacio?->propuesta?->planAnio?->plan?->nombre),

                // Datos del año
                'anio_nombre' => $this->whenLoaded('espacio', fn() => $this->espacio?->propuesta?->planAnio?->anio?->nombre),
                'anio_nombre_completo' => $this->whenLoaded('espacio', fn() => $this->espacio?->propuesta?->planAnio?->anio?->nombre_completo),

                // Datos del turno
                'turno_inicio' => $this->whenLoaded('espacio', function() {
                    return $this->espacio?->propuesta?->turnoInicio?->nombre;
                }),
                // Datos del ciclo lectivo
                'ciclo_lectivo_nombre' => $this->whenLoaded('espacio', function() {
                    return $this->espacio?->propuesta?->cicloLectivo?->nombre;
                }),
            ];

    }
}
