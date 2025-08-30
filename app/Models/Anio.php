<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;


class Anio extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ["nombre","nombre_completo","anio_absoluto",
                           "anio_relativo","orden"];

    public function planAnios(): HasMany
    {
        return $this->hasMany(Plan_Anio::class);
    }

}
