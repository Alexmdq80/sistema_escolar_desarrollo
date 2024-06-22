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
            "id" => $this->id,
            "nombre" => $this->nombre,
            "apellido" => $this->apellido,
            "documento_numero" => $this->documento_numero, 
            "documento_tipo" => [
                "documento_tipo_id" => $this->documento_tipo->id,
                "documento_tipo_nombre" => $this->documento_tipo->nombre 
            ]                
        ]
        ;
    }
}
