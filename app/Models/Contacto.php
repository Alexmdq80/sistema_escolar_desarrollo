<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Contacto extends Model
{
    use HasFactory, SoftDeletes;

    //protected $table = "contacto";
    protected $fillable = ["persona_id","telefono_codigo_area","telefono",
                           "celular_codigo_area","celular","email"
                        ];

    public function persona(): BelongsTo
    {
        return $this->belongsTo(Persona::class);
    }

}
