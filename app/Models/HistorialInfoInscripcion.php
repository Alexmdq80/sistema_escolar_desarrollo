<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class HistorialInfoInscripcion extends Model
{

    use HasFactory, SoftDeletes;

    protected $fillable = [ "historial_inscripcion_id",
                            "cierre_causa_id",
                            "fecha",
                            "observaciones"
                        ];

    protected $casts = [
       'fecha' => 'datetime'
    ];

    public function historialInscripcion(): BelongsTo
    {
        return $this->belongsTo(HistorialInscripcion::class);
    }
    public function cierreCausa(): BelongsTo
    {
        return $this->belongsTo(Cierre_Causa::class);
    }

}
