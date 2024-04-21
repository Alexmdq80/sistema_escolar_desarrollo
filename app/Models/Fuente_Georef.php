<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fuente_Georef extends Model
{
    use HasFactory;

    protected $table = "fuente_georef";

    protected $fillable = ["nombre","orden","vigente"];   


    public function calles() {
        return $this->hasMany(Calle::class, "id_fuente_georef", "id" );
    }
    public function asentamientos() {
        return $this->hasMany(Asentamiento::class, "id_fuente_georef", "id" );
    }
    public function localidades_asentamientos() {
        return $this->hasMany(Localidad_Asentamiento::class, "id_fuente_georef", "id" );
    }
    public function localidades_censales() {
        return $this->hasMany(Localidad_Censal::class, "id_fuente_georef", "id" );
    }
    public function municipios() {
        return $this->hasMany(Municipio::class, "id_fuente_georef", "id" );
    }
    public function departamentos() {
        return $this->hasMany(Departamento::class, "id_fuente_georef", "id" );
    }
    public function provincias() {
        return $this->hasMany(Provincia::class, "id_fuente_georef", "id" );
    }

    public $timestamps = false;

}
