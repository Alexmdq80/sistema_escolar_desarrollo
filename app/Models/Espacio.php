<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Espacio extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ["propuesta_id","seccion_tipo_id","division","nombre"];

    public function propuesta(): BelongsTo
    {
        return $this->belongsTo(Propuesta::class);
    }
    public function seccionTipos(): BelongsTo
    {
        return $this->belongsTo(SeccionTipo::class);
    }
    public function inscripciones(): HasMany
    {
        return $this->hasMany(Inscripcion::class);
    }
    public function historialInscripciones(): HasMany
    {
        return $this->hasMany(HistorialInscripcion::class);
    }

}
