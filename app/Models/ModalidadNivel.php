<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class ModalidadNivel  extends \Illuminate\Database\Eloquent\Relations\Pivot
{
    use HasFactory, SoftDeletes;

    //    protected $table = "escuela_nivel";
    //    protected $table = "modalidad_nivel";

    // public function escuela() {
    //     return $this->belongsTo(Escuela::class, "id", "id_escuela");
    // }
    // public function nivel() {
    //     return $this->belongsTo(Nivel::class, "id", "id_nivel");
    // }
    // public function modalidad() {
    //     return $this->belongsTo(Modalidad::class, "id", "id_modalidad");
    // }
    // Una combinación pertenece a una modalidad
    public function modalidad(): BelongsTo
    {
        return $this->belongsTo(Modalidad::class);
    }

    // Una combinación pertenece a un nivel
    public function nivel(): BelongsTo
    {
        return $this->belongsTo(Nivel::class);
    }

    public function escuelaTipo(): BelongsTo
    {
        // El primer argumento es el modelo al que pertenece
        // El segundo es la clave foránea local que apunta a ese modelo
        return $this->belongsTo(EscuelaTipo::class);
    }
    public function escuelas(): BelongsToMany
    {
        return $this->belongsToMany(Escuela::class);
    }
}
