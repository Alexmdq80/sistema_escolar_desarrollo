<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ambito extends Model
{
    use HasFactory, SoftDeletes;

    //protected $table = "ambito";
    protected $fillable = ["nombre","orden","vigente"];   

    public function escuelas() {
    //    return $this->hasMany(Escuela::class, "id_ambito", "id" );
        return $this->hasMany(Escuela::class);
    }    

}
