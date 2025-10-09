<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ContinenteResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // return parent::toArray($request);
        return [
            // Los campos que solicitaste llenar en el modelo
            'nombre' => $this->nombre,
            // El ID siempre es crucial, especialmente para el frontend (VBA)
            'id' => $this->id,
            //'orden' => $this->orden,
            //'vigente' => (bool) $this->vigente, // Se asegura de que sea booleano

            // Opcional: información de auditoría
            //'created_at' => $this->created_at?->format('Y-m-d H:i:s'),
            //'updated_at' => $this->updated_at?->format('Y-m-d H:i:s'),

            // Opcional: Incluir el número de personas asociadas para tener un resumen rápido
            //'personas_count' => $this->whenCounted('personas'),

            // Opcional: Incluir la colección de personas cuando se solicite (si hiciste un ->load('personas'))
            /*
            'personas' => PersonaResource::collection($this->whenLoaded('personas')),
            */
        ];
    }
}
