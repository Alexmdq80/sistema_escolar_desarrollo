<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CierreCausa extends Model
{

    use HasFactory, SoftDeletes;

    protected $fillable = ["nombre","orden","vigente"];

    public function historialInfoInscripciones(): HasMany
    {
        return $this->hasMany(Historial_Info_Inscripcion::class);
    }

}
