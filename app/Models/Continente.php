<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Continente extends Model
{
    use HasFactory, SoftDeletes;

    //protected $table = "continente";

    protected $fillable = ["nombre",
                           "orden"
                        ];

    /*public function calles() {
        return $this->hasMany(Calle::class, "id_continente", "id" );
    }
    public function asentamientos() {
        return $this->hasMany(Asentamiento::class, "id_continente", "id" );
    }
    public function localidades() {
        return $this->hasMany(Localidad::class, "id_continente", "id" );
    }
    public function localidades_asentamientos() {
        return $this->hasMany(Localidad_Asentamiento::class, "id_continente", "id" );
    }
    public function localidades_censales() {
        return $this->hasMany(Localidad_Censal::class, "id_continente", "id" );
    }
    public function departamentos() {
        return $this->hasMany(Departamento::class, "id_continente", "id" );
    }
    public function municipios() {
        return $this->hasMany(Municipio::class, "id_continente", "id" );
    }
    public function provincias() {
        return $this->hasMany(Provincia::class, "id_continente", "id" );
    }*/
    public function naciones(): HasMany
    {
        return $this->hasMany(Nacion::class);
    }

    //public $timestamps = false;
}
