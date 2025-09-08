<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Propuesta extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ["plan_anio_id",
                            "turno_inicio_id",
                            "turno_fin_id",
                            "jornada_id",
                            "lectivo_id"
                    ];
                    
    public function planAnio() {
        return $this->belongsTo(PlanAnio::class);
    }

    public function turnoInicio() {
        return $this->belongsTo(Turno::class);
    }

    public function turnoFin() {
        return $this->belongsTo(Turno::class);
    }

    public function jornada() {
        return $this->belongsTo(Jornada::class);
    }
    
    public function cicloLectivo() {
        return $this->belongsTo(Lectivo::class);
    }

}
