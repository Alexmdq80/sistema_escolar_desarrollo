<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Documento_Tipo extends Model
{
    use HasFactory, SoftDeletes;

    //protected $table = "documento_tipo";
    protected $fillable = ["nombre","orden","vigente"];

    public function personas() {
        return $this->hasMany(Persona::class);
    }

}
