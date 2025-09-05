<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Region extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ["numero",
                            "vigente",   
                        ];
            
    public function departamento(): BelongsTo
    {
        return $this->belongsTo(Departamento::class);
    }
}
