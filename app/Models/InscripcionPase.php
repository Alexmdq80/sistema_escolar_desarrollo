<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class InscripcionPase extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ["escuela_id", "historial_inscripcion_id",
                            "salida_motivo_id","escuela_ubicacion_id",
                            "otro_motivo","finalizado"
                        ];

    public function escuela(): BelongsTo {
        return $this->belongsTo(Escuela::class);
    }
    public function historialInscripcion(): BelongsTo {
        return $this->belongsTo(HistorialInscripcion::class);
    }
    public function salidaMotivo(): BelongsTo {
        return $this->belongsTo(SalidaMotivo::class);
    }
    public function escuelaUbicacion(): BelongsTo {
        return $this->belongsTo(EscuelaUbicacion::class);
    }
}
