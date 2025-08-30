<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

//class Escuela_Otras_Ofertas extends Model
class EscuelaOferta extends \Illuminate\Database\Eloquent\Relations\Pivot
{
    use HasFactory, SoftDeletes;

    protected $fillable = ["escuela_id","oferta_id"];

    public function escuela(): BelongsTo
    {
        return $this->belongsTo(Escuela::class);
    }
    public function oferta(): BelongsTo
    {
        return $this->belongsTo(Oferta::class);
    }
}
