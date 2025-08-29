<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Anio extends Model
{
    use HasFactory, SoftDeletes;
    
    //protected $table = "anio";

    protected $fillable = ["nombre","nombre_completo","anio_absoluto",
                           "anio_relativo","orden"];

    /*public function ciclo_plan_estudio(){
        return $this->belongsTo(ciclo_plan_estudio::class,"id_ciclo_plan_estudio");
    }
    public function propuestas_institucionales(){
        return $this->hasMany(Propuesta_Institucional::class,"id_anio","id");
    }

    public function espacios_academicos(){
        return $this->hasMany(Espacio_Academico::class,"id_anio","id");
    }    
    */

    public function planAnios(){
    //    return $this->hasMany(Anio_Plan::class,"id_anio","id");
        return $this->hasMany(Plan_Anio::class);
    }
    
}
