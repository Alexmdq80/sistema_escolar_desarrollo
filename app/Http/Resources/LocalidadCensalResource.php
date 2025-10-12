<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LocalidadCensalResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'nombre' => $this->nombre,
            'id' => $this->id,
            'georef_fuente_id' => $this->georef_fuente_id,
            'georef_categoria_id' => $this->georef_categoria_id,
            'georef_funcion_id' => $this->georef_funcion_id,
        ];
    }
}
