<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Modalidad extends Model
{
    use HasFactory, SoftDeletes;

    //protected $table = 'modalidad';

    protected $fillable = ["nombre","orden","vigente"];

    // public function escuela_nivel_modalidad() {
    //     return $this->hasMany(Escuela_Nivel_Modalidad::class, "id_modalidad", "id" );
    // }

//    public function escuelas() {
//        return $this->belongsToMany(Escuela::class, "escuela_nivel_modalidad","id_modalidad", "id_escuela");
//   }
    public function niveles(): BelongsToMany
    {
        return $this->belongsToMany(Nivel::class);
//        return $this->belongsToMany(Nivel::class, 'modalidad_nivel');
    }
    public function inscripciones(): HasMany
    {
        return $this->hasMany(Inscripcion::class);
    }
    public function historialInscripciones(): HasMany
    {
        return $this->hasMany(HistorialInscripcion::class);
    }

}
