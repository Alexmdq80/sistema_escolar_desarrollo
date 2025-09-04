<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PersonaVinculoPersona extends Pivot
{
    use HasFactory, SoftDeletes;

    protected $table = "persona_vinculo_persona";

    protected $fillable = ["persona_estudiante_id",
                          "persona_adulto_id",
                          "vinculo_id",
                          "detalle",
                          "vencimiento_fecha"
                        ];

    protected $casts = [
       'vencimiento_fecha' => 'datetime'
    ];

    public function vinculo(): BelongsTo
    {
        return $this->belongsTo(Vinculo::class);
    }

    /*public function adulto_vinculo(){
        return $this->belongsTo(Adulto_Vinculo::class, "id_adulto_vinculo","id");
    }

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
    public function adulto() {
        return $this->hasMany(Persona::class,  "id", "id_persona_adulto");
    } 
    public function adulto() {
        return $this->belongsTo(Persona::class, "id_persona_adulto", "id");
    }*/

}
