<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Nivel extends Model
{
    use HasFactory, SoftDeletes;

  //  protected $table = 'nivel';
    protected $fillable = ["nombre","orden","vigente"];

    // public function escuela_nivel_modalidad() {
    //     return $this->hasMany(Escuela_Nivel_Modalidad::class, "id_nivel", "id" );
    // }

//    public function escuelas() {
//        return $this->belongsToMany(Escuela::class, "escuela_nivel_modalidad","id_nivel","id_escuela");
//    }
    public function modalidades(): BelongsToMany
    {
        return $this->belongsToMany(Modalidad::class);
        //        return $this->belongsToMany(Modalidad::class, 'modalidad_nivel');
    }
    public function inscripciones(): HasMany
    {
        return $this->hasMany(Inscripcion::class); // nivel de la escuela de procedencia
    }
    public function historialInscripciones(): HasMany
    {
        return $this->hasMany(HistorialInscripcion::class); // nivel de la escuela de procedencia en el historial
    }

}
