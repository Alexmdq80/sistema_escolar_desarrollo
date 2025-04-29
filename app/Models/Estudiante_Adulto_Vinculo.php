<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estudiante_Adulto_Vinculo extends Model
{
    use HasFactory;

    protected $table = "estudiante_adulto_vinculo";

    protected $fillable = ["detalle","vencimiento_fecha"];

    public function adulto_vinculo(){
        return $this->belongsTo(Adulto_Vinculo::class, "id_adulto_vinculo","id");
    }

   /* public function inscripcion_firma(){
      return $this->hasMany(Inscripcion::class,"id_persona_firma","id");
    }*/

    public function inscripcion_responsable_1(){
      return $this->belongsTo(Inscripcion::class,"responsable_1","id");
    }

    public function inscripcion_responsable_2(){
      return $this->belongsTo(Inscripcion::class,"responsable_2","id");
    }

    public function inscripcion_restringida(){
      return $this->belongsTo(Inscripcion::class,"restringida","id");
    }

    public function estudiante() {
        return $this->belongsTo(Persona::class, "id_persona_estudiante", "id");
    }
   /* public function adulto() {
        return $this->hasMany(Persona::class,  "id", "id_persona_adulto");
    } */
    public function adulto() {
        return $this->belongsTo(Persona::class, "id_persona_adulto", "id");
    }

}
