<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estudiante_Adulto extends Model
{
    use HasFactory;

    protected $table = "estudiante_adulto";

    public function Vinculable(){
        return $this->morphTo();
    }


}
