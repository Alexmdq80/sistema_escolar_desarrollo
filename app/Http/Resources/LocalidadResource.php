<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
//use Illuminate\Support\Facades\Log;

class LocalidadResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $objeto = $this->whenLoaded('departamento', function () {
            $continenteId = $this->departamento?->provincia?->nacion?->continente_id;
            $nacionId = $this->departamento?->provincia?->nacion?->id;
            $provinciaId = $this->departamento?->provincia?->id;

            return [
                'continenteId' => $continenteId,
                'nacionId' => $nacionId,
                'provinciaId' => $provinciaId
            ];
        });

        return [
            'nombre' => $this->nombre,
            'id' => $this->id,
            'localidad_censal_id' => $this->localidad_censal_id,
            'departamento_id' => $this->departamento_id,
            'municipio_id' => $this->municipio_id,
            'provincia_id' => $objeto['provinciaId'] ?? null,
            'nacion_id' => $objeto['nacionId'] ?? null,
            'continente_id' => $objeto['continenteId'] ?? null,
            'georef_fuente_id' => $this->georef_fuente_id,
            'georef_categoria_id' => $this->georef_categoria_id,
        ];
    }
}
