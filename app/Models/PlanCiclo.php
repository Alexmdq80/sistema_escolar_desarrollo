<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class PlanCiclo extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ["nombre",
                            "orden",
                            "vigente"
                        ];

    public function planes(): HasMany
    {
        return $this->hasMany(Plan::class);
    }

}
