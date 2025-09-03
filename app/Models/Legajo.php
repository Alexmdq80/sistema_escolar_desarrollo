<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Legajo extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ["persona_id","escuela_id","libro"
                            ,"folio","legajo"
                        ];

    public function persona(): BelongsTo
    {
        return $this->belongsTo(Persona::class);
    }
    
}
