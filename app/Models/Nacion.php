<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Nacion extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ["id_georef",
                            "continente_id",
                            "nombre",
                            "nacionalidad"
                        ]; 

    public function continente(): BelongsTo 
    {
        return $this->belongsTo(Continente::class);
    }
    public function provincias(): HasMany
    {
        return $this->hasMany(Provincia::class);
    }
    public function personas(): HasMany
    {
        return $this->hasMany(Persona::class);
    }
    public function nacionalidadPersonas(): HasMany
    {
        return $this->hasMany(Persona::class, "nacionalidad_nacion_id", "id" );
    }  

}
