<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Propuesta extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ["escuela_id",
                            "plan_anio_id",
                            "turno_inicio_id",
                            "turno_fin_id",
                            "jornada_id",
                            "lectivo_id"
                    ];

    public function escuela(): BelongsTo {
        return $this->belongsTo(Escuela::class);
    }
    public function planAnio(): BelongsTo {
        return $this->belongsTo(PlanAnio::class);
    }
    public function turnoInicio(): BelongsTo {
        return $this->belongsTo(Turno::class, "turno_inicio_id","id");
    }
    public function turnoFin(): BelongsTo    {
        return $this->belongsTo(Turno::class, "turno_fin_id","id");
    }
    public function jornada(): BelongsTo {
        return $this->belongsTo(Jornada::class);
    }
    public function cicloLectivo(): BelongsTo {
        return $this->belongsTo(Lectivo::class, 'lectivo_id');
    }
    public function espacios(): HasMany {
        return $this->hasMany(Espacio::class);
    }
    public function escuelas(): BelongsToMany
    {
        return $this->belongsToMany(Escuela::class, 'escuela_propuesta', 'propuesta_id', 'escuela_id')
                    ->using(EscuelaPropuesta::class);
    }
}
