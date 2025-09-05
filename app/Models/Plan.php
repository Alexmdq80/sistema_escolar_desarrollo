<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Plan extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ["plan_ciclo_id".
                            "nombre",
                            "nombre_completo",
                            "duracion_anios",
                            "resolucion",
                            "orientacion"
                        ];

    public function planAnios(): HasMany 
    {
        return $this->hasMany(PlanAnio::class);
    }
    public function planCiclo(): BelongsTo
    {
        return $this->belongsTo(PlanCiclo::class);
    }
}
