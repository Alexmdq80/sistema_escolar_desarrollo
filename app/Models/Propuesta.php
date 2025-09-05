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
