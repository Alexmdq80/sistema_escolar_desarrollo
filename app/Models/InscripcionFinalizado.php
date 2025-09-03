<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class InscripcionFinalizado extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ["historial_inscripcion_id", "condicion_id"
                        ];

    public function historialInscripcion(): BelongsTo {
        return $this->belongsTo(HistorialInscripcion::class);
    }

    public function condicionFinalizacion(){
        return $this->belongsTo(Condicion::class);
    }
}
