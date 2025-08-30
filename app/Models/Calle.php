<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Calle extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ["nombre",
                           "altura_fin_derecha","altura_fin_izquierda",
                           "altura_inicio_derecha","altura_inicio_izquierda",
                           "localidad_censal_id", "georef_fuente_id",
                           "georef_categoria_id"
    ];
    // belongsTo
    public function localidadCensal(): BelongsTo
    {
        return $this->belongsTo(Localidad_Censal::class);
    }
    public function georefCategoria(): BelongsTo
    {
        return $this->belongsTo(Georef_Categoria::class);
    }
    public function georefFuente(): BelongsTo
    {
        return $this->belongsTo(Georef_Fuente::class);
    }
    // hasMany
    public function domicilioCalles(): HasMany {
        return $this->hasMany(Domicilio::class);
    }
    public function domicilioEntreCalles1(): HasMany
    {
        return $this->hasMany(Domicilio::class, "calle_entre_1_id", "id" );
    }
    public function domicilioEntreCalles2(): HasMany
    {
        return $this->hasMany(Domicilio::class, "calle_entre_2_id", "id" );
    }
}
