<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;

class DocumentoTipo extends Model
{
    use HasFactory, SoftDeletes;

    //protected $table = "documento_tipo";
    protected $fillable = ["nombre","orden","vigente"];

    public function personas(): HasMany
    {
        return $this->hasMany(Persona::class);
    }

}
