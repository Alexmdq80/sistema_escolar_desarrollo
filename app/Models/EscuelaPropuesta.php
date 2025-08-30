<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EscuelaPropuesta extends \Illuminate\Database\Eloquent\Relations\Pivot
{
    use HasFactory, SoftDeletes;

    protected $fillable = ["escuela_id","propuesta_id"];

    public function escuela(): BelongsTo
    {
        return $this->belongsTo(Escuela::class);
    }
    public function propuesta(): BelongsTo
    {
        return $this->belongsTo(Propuesta::class);
    }
}
