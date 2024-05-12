<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Persona_Responsable extends Model
{
    use HasFactory;

    protected $table = "persona_responsable";

    protected $fillable = ["id_persona_estudiante","id_persona_responsable","id_responsable_vinculo"]; 
}
