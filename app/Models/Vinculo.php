<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Vinculo extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ["vinculo_tipo_id",
                            "nombre",
                            "orden",
                            "vigente"
                        ];

    public function pvps(): HasMany
    {
        return $this->hasMany(Persona_Vinculo_Persona::class);
    }
    public function vinculoTipo(): BelongsTo
    {
        return $this->belongsTo(VinculoTipo::class);
    }

}
