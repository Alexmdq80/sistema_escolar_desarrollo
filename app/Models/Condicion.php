<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Condicion extends Model
{
    use HasFactory, SoftDeletes;

    //protected $table = "condicion";
    protected $fillable = ["nombre","orden","vigente"];

    public function inscripciones(): HasMany
    {
        return $this->hasMany(Inscripcion::class);
    }
    public function inscripcionFinalizados(): HasMany
    {
        return $this->hasMany(Inscripcion_Finalizado::class);
    }
    public function historialInscripciones(): HasMany
    {
        return $this->hasMany(Historial_Inscripcion::class);
    }
}
