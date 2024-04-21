<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Calle extends Model
{
    use HasFactory;

    protected $table = "calle";

    protected $fillable = ["nombre",
                           "altura_fin_derecha","altura_fin_izquierda",
                           "altura_inicio_derecha","altura_inicio_izquierda"
    ];   

    public function departamento(){
        return $this->belongsTo(Departamento::class, "id_departamento");
    }
    public function provincia(){
        return $this->belongsTo(Provincia::class, "id_provincia");
    }
    public function pais(){
        return $this->belongsTo(Pais::class, "id_pais");
    }
    public function continente(){
        return $this->belongsTo(Continente::class, "id_continente");
    }
    public function localidad_censal(){
        return $this->belongsTo(Localidad_Censal::class, "id_localidad_censal");
    }

    public function categoria_georef() {
        return $this->belongsTo(Categoria_Georef::class, "id_categoria_georef");
    }
    public function fuente() {
        return $this->belongsTo(Fuente::class, "id_fuente_georef");
    }

    public $timestamps = false;
}
