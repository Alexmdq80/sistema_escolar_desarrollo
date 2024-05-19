<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Adulto_Vinculo extends Model
{
    use HasFactory;

    protected $table = "adulto_vinculo";

    protected $fillable = ["nombre","orden","vigente"];

    public function adultos(){
        return $this->hasMany(Estudiante_Adulto::class,"id_persona_adulto","id");
    }
    public function estudiantes(){
        return $this->hasMany(Estudiante_Adulto::class,"id_persona_estudiante","id");
    }

}
