<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cierre_Causa extends Model
{
    //protected $table = "inscripcion_cierre";

    use HasFactory, SoftDeletes;
  
    protected $fillable = ["nombre","orden","vigente"];

    public function historialInfoInscripciones(){
        return $this->hasMany(Historial_Info_Inscripcion::class);
    }    

}
