<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DepartamentoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $nacion = null;
        $nacion = $this->whenLoaded('provincia', function () {
            return $nacion = $this->provincia?->nacion;;
        });
        $continenteId = null;
        $continenteId = $nacion?->continente_id;
        $nacionId = null;
        $nacionId = $this->whenLoaded('provincia', function () {
            // Usamos la encadenación opcional (?->) para acceder a las relaciones anidadas
            // y devolvemos la clave foránea (continente_id) que está en el modelo Nacion.
            // Si la relación no existe, devuelve null.
            return $this->provincia?->nacion_id;

            // Si necesitaras acceder al ID primario del Continente (su 'id' en la tabla 'continentes'):
            // return $this->nacion?->continente?->id;
        });

 // return parent::toArray($request);
        return [
            // Los campos que solicitaste llenar en el modelo
            'nombre' => $this->nombre,
            'nombre_completo' => $this->nombre_completo,
            'id' => $this->id,
            'provincia_id' => $this->provincia_id,
            'nacion_id' => $nacionId,
            'continente_id' => $continenteId,
            'georef_fuente_id' => $this->georef_fuente_id,
            'georef_categoria_id' => $this->georef_categoria_id,
            'region_id' => $this->region_id,
            'distrito_numero' => $this->distrito_numero,
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
