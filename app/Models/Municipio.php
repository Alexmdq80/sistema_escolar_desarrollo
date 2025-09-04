<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Municipio extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ["id_georef",
                            "provincia_id",
                            "georef_fuente_id",
                            "georef_categoria_id", 
                            "nombre",
                            "nombre_completo",
                            "centroide_lat",
                            "centroide_lon",
                            "provincia_interseccion"
    ];

    public function georefFuente(): BelongsTo 
    {
        return $this->belongsTo(GeorefFuente::class);
    }
    public function georefCategoria(): BelongsTo
    {
        return $this->belongsTo(GeorefCategoria::class);
    }
    public function provincia(): BelongsTo
    {
        return $this->belongsTo(Provincia::class);
    }

}
