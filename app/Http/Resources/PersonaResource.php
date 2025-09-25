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
        
        $legajo = $this->legajos->first();

        return [
            'Nombres' => $this->nombre ?? '',
            'Apellidos' => $this->apellido ?? '',
            'Número de Documento' => $this->documento_numero ?? '',
            'Tipo de Documento' => $this->whenLoaded('documentoTipo', function () {
                return $this->documentoTipo?->nombre ?? '';
            }),
            'Sexo' => $this->sexo?->nombre ?? '',
            'Género' => $this->genero?->nombre ?? '',
            // Datos del legajo
            'Libro' => optional($legajo)->libro ?? '',
            'Folio' => optional($legajo)->folio ?? '',
            'Legajo' => optional($legajo)->legajo ?? '',
            'Inscripción' => $this->tiene_inscripcion_activa ? 'Activa' : 'Inactiva', 
            'id' => $this->id ?? '',
        ];
    }
}
