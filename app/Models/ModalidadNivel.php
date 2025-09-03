<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class ModalidadNivel  extends \Illuminate\Database\Eloquent\Relations\Pivot
{
    use HasFactory, SoftDeletes;
  
    protected $fillable = ["nivel_id","modalidad_id","escuela_tipo_id"];

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
        return $this->belongsTo(EscuelaTipo::class);
    }
    public function escuelas(): BelongsToMany
    {
        return $this->belongsToMany(Escuela::class)
                    ->using(EscuelaModalidadNivel::class);
    }
}
