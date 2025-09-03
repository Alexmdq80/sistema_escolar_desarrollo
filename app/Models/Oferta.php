<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Oferta extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ["nombre","orden","vigente"];

    public function escuelas() {
        return $this->belongsToMany(Escuela::class);
    }


}
