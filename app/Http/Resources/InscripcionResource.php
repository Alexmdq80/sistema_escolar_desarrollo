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
        /*return [
            // Datos del ciclo lectivo
            'ciclo_lectivo_nombre' => (string) $this->whenLoaded('espacio', function() {
                return $this->espacio?->propuesta?->cicloLectivo?->nombre ?? '';
            }),
            // Datos del turno
            'turno_inicio' => (string) $this->whenLoaded('espacio', function() {
                return $this->espacio?->propuesta?->turnoInicio?->nombre ?? '';
            }),
            // Datos del plan de estudio
            'plan_nombre' => (string) $this->whenLoaded('espacio', fn() => $this->espacio?->propuesta?->planAnio?->plan?->nombre ?? ''),
            // ...

            // Forzar la conversión a string en la concatenación para evitar problemas de codificación
            'curso_division' => (string) $this->whenLoaded('espacio', function() {
                $anio = $this->espacio?->propuesta?->planAnio?->anio?->nombre ?? '';
                $division = $this->espacio?->division ?? '';
                return trim($anio . ' ' . $division);
            }),
            // Datos del estudiante y su documento
            'estudiante_nombre' => (string) $this->whenLoaded('persona', fn() => $this->persona->nombre ?? ''),
            'estudiante_apellido' => (string) $this->whenLoaded('persona', fn() => $this->persona?->apellido ?? ''),
            'persona_sexo' => (string) $this->whenLoaded('persona', fn() => $this->persona?->sexo?->nombre ?? ''),
            'persona_genero' => (string) $this->whenLoaded('persona', fn() => $this->persona?->genero?->nombre ?? ''),
            'documento_numero' => (string) $this->whenLoaded('persona', fn() => $this->persona?->documento_numero ?? ''),
            'documento_tipo' => (string) $this->whenLoaded('persona', function () {
                return $this->persona?->documentoTipo?->nombre ?? '';
            }),
            // Datos de la inscripción
            'inscripcion_id' => $this->id,
            'fecha_inscripcion' => (string) $this->fecha?->format('Y-m-d H:i:s') ?? '',
        ];*/
        return [
                // Datos del ciclo lectivo
                'ciclo_lectivo_nombre' => $this->whenLoaded('espacio', function() {
                    return $this->espacio?->propuesta?->cicloLectivo?->nombre ?? '';
                }),
                // Datos del turno
                'turno_inicio' => $this->whenLoaded('espacio', function() {
                    return $this->espacio?->propuesta?->turnoInicio?->nombre ?? '';
                }),
                // Datos del plan de estudio
                'plan_nombre' => $this->whenLoaded('espacio', fn() => $this->espacio?->propuesta?->planAnio?->plan?->nombre ?? ''),
                // Datos del año
                //'anio_nombre' => $this->whenLoaded('espacio', fn() => $this->espacio?->propuesta?->planAnio?->anio?->nombre ?? ''),
                //'anio_nombre_completo' => $this->whenLoaded('espacio', fn() => $this->espacio?->propuesta?->planAnio?->anio?->nombre_completo ?? ''),
                // Datos del espacio (división)
                // 'division_nombre' => $this->whenLoaded('espacio', fn() => $this->espacio?->division_nombre ?? ''),
                //'division_numero' => $this->whenLoaded('espacio', fn() => $this->espacio?->division ?? ''),
                'curso_division' => $this->whenLoaded('espacio', function() {
                    $anio = $this->espacio?->propuesta?->planAnio?->anio?->nombre ?? '';
                    $division = $this->espacio?->division ?? '';
                    return trim($anio . ' ' . $division);
                }),
                // Datos del estudiante y su documento
                'estudiante_nombre' => $this->whenLoaded('persona', fn() => $this->persona->nombre ?? ''),
                'estudiante_apellido' => $this->whenLoaded('persona', fn() => $this->persona?->apellido ?? ''),
                'persona_sexo' => $this->whenLoaded('persona', fn() => $this->persona?->sexo?->nombre ?? ''),
                'persona_genero' => $this->whenLoaded('persona', fn() => $this->persona?->genero?->nombre ?? ''),
                'documento_numero' => $this->whenLoaded('persona', fn() => $this->persona?->documento_numero ?? ''),
                'documento_tipo' => $this->whenLoaded('persona', function () {
                    return $this->persona?->documentoTipo?->nombre ?? '';
                }),
                // Datos de la inscripción
                'inscripcion_id' => $this->id,
                'fecha_inscripcion' => $this->fecha?->format('Y-m-d') ?? '',

            ];

    }
}
