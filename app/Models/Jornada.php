<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Jornada extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ["nombre","orden"];

    public function propuestasInstitucionales(): BelongsTo {
        return $this->hasMany(Propuesta::class);
    } 

}
