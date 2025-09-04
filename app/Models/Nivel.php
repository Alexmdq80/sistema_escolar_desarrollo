<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Nivel extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ["nombre","orden","vigente"];

    public function modalidades(): BelongsToMany
    {
        return $this->belongsToMany(Modalidad::class)
                    ->using(ModalidadNivel::class);
    }
    public function inscripciones(): HasMany
    {
        return $this->hasMany(Inscripcion::class); // nivel de la escuela de procedencia
    }
    public function historialInscripciones(): HasMany
    {
        return $this->hasMany(HistorialInscripcion::class); // nivel de la escuela de procedencia en el historial
    }

}
