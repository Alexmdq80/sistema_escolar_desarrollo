<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Provincia extends Model
{

    use HasFactory, SoftDeletes;

    protected $fillable = ["id_georef",
                            "nacion_id",
                            "georef_fuente_id",
                            "georef_categoria_id",
                            "nombre",
                            "nombre_completo",
                            "iso_nombre",
                            "iso_id",
                            "centroide_lat",
                            "centroide_lon"    
                        ];

    public function nacion(): BelongsTo
    {
        return $this->belongsTo(Nacion::class);
    }
    public function georefCategoria(): BelongsTo
    {
        return $this->belongsTo(GeorefCategoria::class);
    }
    public function georefFuente(): BelongsTo
    {
        return $this->belongsTo(GeorefFuente::class);
    }

    public function departamentos(): HasMany 
    {
        return $this->hasMany(Departamento::class);
    }
    public function municipios(): HasMany
    {
        return $this->hasMany(Municipio::class);
    }
    public function personas(): HasMany
    {
        return $this->hasMany(Persona::class);
    }
}
