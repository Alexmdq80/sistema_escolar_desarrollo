<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SalidaMotivo extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ["nombre",
                            "orden",
                            "vigente",   
                        ];
            
    public function inscripcionBajas(): HasMany
    {
        return $this->HasMany(InscripcionBajas::class);
    }
    public function inscripcionPases(): HasMany
    {
        return $this->HasMany(InscripcionPases::class);
    }        
}
