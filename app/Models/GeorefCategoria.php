<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;

class GeorefCategoria extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ["nombre","orden","vigente"];

    public function calles(): HasMany
    {
        return $this->hasMany(Calle::class);
    }
    public function asentamientos(): HasMany
    {
        return $this->hasMany(Asentamiento::class);
    }
    public function localidades(): HasMany
    {
    return $this->hasMany(Localidad::class);
    }
    public function localidadesCensales(): HasMany
    {
        return $this->hasMany(LocalidadCensal::class);
    }
    public function municipios(): HasMany
    {
        return $this->hasMany(Municipio::class);
    }
    public function departamentos(): HasMany
    {
        return $this->hasMany(Departamento::class);
    }
    public function provincias(): HasMany
    {
        return $this->hasMany(Provincia::class);
    }

}
