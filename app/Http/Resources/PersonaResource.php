<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Persona;

class PersonaResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'Nombres' => $this->nombre ?? '',
            'Apellidos' => $this->apellido ?? '',
            'Número de Documento' => $this->documento_numero ?? '',
            'Tipo de Documento' => $this->whenLoaded('documentoTipo', function () {
                return $this->documentoTipo?->nombre ?? '';
            }),
            'Inscripción' => $this->tiene_inscripcion_activa ? 'Activa' : '',
            'id' => $this->id ?? '',
        ];
    }
}
