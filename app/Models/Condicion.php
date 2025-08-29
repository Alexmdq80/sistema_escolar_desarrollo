<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Condicion extends Model
{
    use HasFactory, SoftDeletes;

    //protected $table = "condicion";
    protected $fillable = ["nombre","orden","vigente"];

    public function inscripciones(){
        return $this->hasMany(Inscripcion::class);
    }
    public function inscripcionFinalizados() {
        return $this->hasMany(Inscripcion_Finalizado::class);
    }
    public function historialInscripciones(){
        return $this->hasMany(Historial_Inscripcion::class);
    }
}
