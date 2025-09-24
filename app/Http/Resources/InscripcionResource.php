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
        $legajo = $this->whenLoaded('persona', fn() => $this->persona->legajos->first());


        return [
                // Datos del ciclo lectivo
                'Ciclo Lectivo' => $this->whenLoaded('espacio', function() {
                    return $this->espacio?->propuesta?->cicloLectivo?->nombre ?? '';
                }),
                // Datos del turno
                'Turno' => $this->whenLoaded('espacio', function() {
                    return $this->espacio?->propuesta?->turnoInicio?->nombre ?? '';
                }),
                // Datos del plan de estudio
                'Plan de Estudio' => $this->whenLoaded('espacio', fn() => $this->espacio?->propuesta?->planAnio?->plan?->nombre ?? ''),
                // Datos del año
                //'anio_nombre' => $this->whenLoaded('espacio', fn() => $this->espacio?->propuesta?->planAnio?->anio?->nombre ?? ''),
                //'anio_nombre_completo' => $this->whenLoaded('espacio', fn() => $this->espacio?->propuesta?->planAnio?->anio?->nombre_completo ?? ''),
                // Datos del espacio (división)
                // 'division_nombre' => $this->whenLoaded('espacio', fn() => $this->espacio?->division_nombre ?? ''),
                //'division_numero' => $this->whenLoaded('espacio', fn() => $this->espacio?->division ?? ''),
                'Curso' => $this->whenLoaded('espacio', function() {
                    $anio = $this->espacio?->propuesta?->planAnio?->anio?->nombre ?? '';
                    $division = $this->espacio?->division ?? '';
                    return trim($anio . ' ' . $division);
                }),
                // Datos del estudiante y su documento
                'Nombres' => $this->whenLoaded('persona', fn() => $this->persona->nombre ?? ''),
                'Apellidos' => $this->whenLoaded('persona', fn() => $this->persona?->apellido ?? ''),
                'Sexo' => $this->whenLoaded('persona', fn() => $this->persona?->sexo?->nombre ?? ''),
                'Género' => $this->whenLoaded('persona', fn() => $this->persona?->genero?->nombre ?? ''),
                'Número de Documento' => $this->whenLoaded('persona', fn() => $this->persona?->documento_numero ?? ''),
                'Tipo de Documento' => $this->whenLoaded('persona', function () {
                    return $this->persona?->documentoTipo?->nombre ?? '';
                }),
                // Datos del legajo
                'Libro' => optional($legajo)->libro ?? '',
                'Folio' => optional($legajo)->folio ?? '',
                'Legajo' => optional($legajo)->legajo ?? '',
                // Datos de la inscripción
                'ID Inscripción' => $this->id,
                'ID Estudiante' => $this->whenLoaded('persona', fn() => $this->persona?->id ?? ''),
                'Fecha de Inscripción' => $this->fecha?->format('Y-m-d') ?? '',

            ];

    }
}
