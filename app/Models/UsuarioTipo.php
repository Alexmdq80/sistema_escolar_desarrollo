<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;

class UsuarioTipo extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ["nombre",
                            "orden",
                            "vigente"
                        ];

    public function escuelaUsuarios(): HasMany
    {
        return $this->hasMany(EscuelaUsuario::class);
    }


}
