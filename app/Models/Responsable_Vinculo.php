<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Responsable_Vinculo extends Model
{
    use HasFactory;

    protected $table = "responsable_vinculo";

    protected $fillable = ["nombre","orden","vigente"];

    public function personas_responsables(){
        return $this->hasMany(Persona_Responsable::class,"id_responsable_vinculo","id");
    }
    public function personas_estudiantes(){
        return $this->hasMany(Persona_Responsable::class,"id_estudiante_vinculo","id");
    }

}
