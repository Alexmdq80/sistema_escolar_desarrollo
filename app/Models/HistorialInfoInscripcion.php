<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class HistorialInfoInscripcion extends Model
{

    use HasFactory, SoftDeletes;

    protected $fillable = ["historial_inscripcion_id","cierre_causa_id","fecha",
                            "observaciones"
                            ];

    protected $casts = [
       'fecha' => 'datetime'
    ];

}
