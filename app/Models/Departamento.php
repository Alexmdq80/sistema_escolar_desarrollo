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

    //protected $table = "departamento";

    protected $fillable = ["id_georef","provincia_id", "georef_fuente",
                            "georef_categoria","nombre","nombre_completo",
                           "centroide_lat","centroide_lon",
                           "provincia_interseccion", "region_id",
                           "distrito_numero"
                        ];

    /*public function calles() {
        return $this->hasMany(Calle::class, "id_departamento", "id" );
    }
    public function asentamientos() {
        return $this->hasMany(Asentamiento::class, "id_departamento", "id" );
    }
    public function localidades() {
        return $this->hasMany(Localidad::class, "id_departamento", "id" );
    }
    public function localidades_asentamientos() {
        return $this->hasMany(Localidad_Asentamiento::class, "id_departamento", "id" );
    }
    public function localidades_censales() {
        return $this->hasMany(Localidad_Censal::class, "id_departamento", "id" );
    }
    public function pais(){
        return $this->belongsTo(Pais::class, "id_pais");
    }
    public function continente(){
        return $this->belongsTo(Continente::class, "id_continente");
    }
    public function domicilios() {
        return $this->hasMany(Domicilio::class, "id_departamento", "id" );
    }*/
    public function provincia(){
        return $this->belongsTo(Provincia::class);
    }
    public function georef_categoria(): BelongsTo
    {
        return $this->belongsTo(Georef_Categoria::class);
    }
    public function georef_fuente(): BelongsTo
    {
        return $this->belongsTo(Georef_Fuente::class);
    }

    public function localidades(): HasMany
    {
        return $this->hasMany(Localidad::class);
    }
    public function georefLocalidades(): HasMany
    {
        return $this->hasMany(Georef_Localidad::class);
    }
    public function georefAsentamientos(): HasMany
    {
        return $this->hasMany(Georef_Asentamiento::class);
    }
    public function personas(): HasMany
    {
        return $this->hasMany(Persona::class);
    }

}
