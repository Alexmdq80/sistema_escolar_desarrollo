<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProvinciaResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $continenteId = null;
        $continenteId = $this->whenLoaded('nacion', function () {
            // Usamos la encadenación opcional (?->) para acceder a las relaciones anidadas
            // y devolvemos la clave foránea (continente_id) que está en el modelo Nacion.
            // Si la relación no existe, devuelve null.
            return $this->nacion?->continente_id;

            // Si necesitaras acceder al ID primario del Continente (su 'id' en la tabla 'continentes'):
            // return $this->nacion?->continente?->id;
        });

 // return parent::toArray($request);
        return [
            // Los campos que solicitaste llenar en el modelo
            'nombre' => $this->nombre,
            'nombre_completo' => $this->nombre_completo,
            'iso_nombre' => $this->iso_nombre,
            'id' => $this->id,
            'nacion_id' => $this->nacion_id,
            'continente_id' => $continenteId,
            'georef_fuente_id' => $this->georef_fuente_id,
            'georef_categoria_id' => $this->georef_categoria_id,
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
