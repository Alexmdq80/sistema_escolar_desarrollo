<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Departamento extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ["id_georef",
                            "provincia_id",
                            "georef_fuente",
                            "georef_categoria",
                            "nombre",
                            "nombre_completo",
                            "centroide_lat",
                            "centroide_lon",
                            "provincia_interseccion",
                            "region_id",
                            "distrito_numero"
                        ];

    public function provincia(): BelongsTo
    {
        return $this->belongsTo(Provincia::class);
    }
    public function regiones(): HasMany
    {
        return $this->hasMany(Region::class);
    }
    public function georefCategoria(): BelongsTo
    {
        return $this->belongsTo(GeorefCategoria::class);
    }
    public function georefFuente(): BelongsTo
    {
        return $this->belongsTo(GeorefFuente::class);
    }

    public function localidades(): HasMany
    {
        return $this->hasMany(Localidad::class);
    }
    public function georefLocalidades(): HasMany
    {
        return $this->hasMany(GeorefLocalidad::class);
    }
    public function georefAsentamientos(): HasMany
    {
        return $this->hasMany(GeorefAsentamiento::class);
    }
    public function personas(): HasMany
    {
        return $this->hasMany(Persona::class);
    }

}
