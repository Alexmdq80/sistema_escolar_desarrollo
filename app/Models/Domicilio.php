<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Domicilio extends Model
{
    use HasFactory, SoftDeletes;

    //protected $table = 'domicilio';

    protected $fillable = ["persona_id",
                            "lcalidad_id",
                            "calle_id",
                            "calle_entre_1_id",
                            "calle_entre_2_id",
                            "numero",
                            "piso",
                            "torre",
                            "departamento",
                            "otros",
                            "codigo_postal"
                        ];

    public function persona(): BelongsTo
    {
        return $this->belongsTo(Persona::class);
    }
    public function localidad(): BelongsTo
    {
        return $this->belongsTo(Localidad::class);
    }
    public function calle(): BelongsTo
    {
        return $this->belongsTo(Calle::class);
    }
    public function entreCalle1(): BelongsTo
    {
        return $this->belongsTo(Calle::class,"calle_entre_1_id");
    }
    public function entreCalle2(): BelongsTo
    {
        return $this->belongsTo(Calle::class,"calle_entre_2_id");
    }

}
