<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class InscripcionBaja extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ["historial_inscripcion_id", "salida_motivo_id",
                            "otro_motivo","accion_contacto","accion_prevencion",
                            "accion_equipo","accion_otros","accion_ninguna"
                        ];

    public function historialInscripcion(): BelongsTo {
        return $this->belongsTo(HistorialInscripcion::class);
    }
    public function salidaMotivo(): BelongsTo {
        return $this->belongsTo(SalidaMotivo::class);
    }

}
