<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Restriccion_Vinculo extends Model
{
    use HasFactory;

    protected $table = "restriccion_vinculo";

    protected $fillable = ["nombre","orden","vigente"];

   
    public function vinculo(){
        return $this->morphMany(Estudiante_Adulto::class,'vinculable');
    }
}
