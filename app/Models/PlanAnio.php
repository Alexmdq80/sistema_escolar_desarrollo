<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PlanAnio extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ["plan_id".
                            "anio_id",
                        ];

    public function plan(): BelongsTo 
    {
        return $this->belongsTo(Plan::class);
    }
    public function anio(): BelongsTo 
    {
        return $this->belongsTo(Anio::class);
    }
    public function propuestas(): HasMany
    {
        return $this->hasMany(Propuesta::class);
    }

}
