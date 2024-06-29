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
            "id" => $this->id,
            "id_persona" => $this->id_persona,
            "id_persona_firma" => $this->id_persona_firma,
            "ciclo_lectivo" => $this->espacio_academico->ciclo_lectivo,
            "espacio_academico" => $this->espacio_academico,
            "anio" => $this->espacio_academico->anio,
            "estudiante" => $this->persona,
            "documento_tipo" => $this->persona->documento_tipo,
            "legajo" =>$this->persona->legajo                
        ]
        ;
    }
}
