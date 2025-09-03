<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class LocalidadCensal extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ["id_georef",
                            "georef_fuente_id",
                            "georef_categoria_id", 
                            "georef_funcion_id",
                            "nombre",
                            "centroide_lat",
                            "centroide_lon",
    ];

    public function georefFuente(): BelongsTo 
    {
        return $this->belongsTo(GeorefFuente::class);
    }
    public function georefCategoria(): BelongsTo
    {
        return $this->belongsTo(GeorefCategoria::class);
    }
    public function georefFuncion(): BelongsTo
    {
        return $this->belongsTo(GeorefFuncion::class);
    }
    public function localidades(): HasMany
    {
        return $this->hasMany(Localidad::class);
    }
    public function georefAsentamientos(): HasMany
    {
        return $this->hasMany(GeorefAsentamiento::class);
    }
    public function georefLocalidades(): HasMany
    {
        return $this->hasMany(GeorefLocalidad::class);
    }
    public function calles(): HasMany
    {
        return $this->hasMany(Calle::class);
    }     


}
