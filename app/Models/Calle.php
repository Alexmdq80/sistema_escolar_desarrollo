<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Calle extends Model
{
    use HasFactory, SoftDeletes;

    //protected $table = "calle";

    protected $fillable = ["nombre",
                           "altura_fin_derecha","altura_fin_izquierda",
                           "altura_inicio_derecha","altura_inicio_izquierda",
                           "localidad_censal_id", "georef_fuente_id",
                           "georef_categoria_id"
    ];   

   /* public function departamento(){
    //    return $this->belongsTo(Departamento::class, "id_departamento");
        return $this->belongsTo(Departamento::class);
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
    */
    public function localidadCensal(){
    //    return $this->belongsTo(Localidad_Censal::class, "id_localidad_censal");
        return $this->belongsTo(Localidad_Censal::class);
    }
    public function georefCategoria() {
        return $this->belongsTo(Georef_Categoria::class);
    }
    public function georefFuente() {
        return $this->belongsTo(Georef_Fuente::class);
    }
    public function domicilioCalles() {
        return $this->hasMany(Domicilio::class);
    }
    public function domicilioEntreCalles1() {
        return $this->hasMany(Domicilio::class, "calle_entre_1_id", "id" );
    }
    public function domicilioEntreCalles2() {
        return $this->hasMany(Domicilio::class, "calle_entre_2_id", "id" );
    }

//    public $timestamps = false;
}
