<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Escuela extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ["localidad_id",
                            "ambito_id",
                            "dependencia_id",
                            "sector_id",
                            "cue_anexo",
                            "clave_provincial",
                            "nombre",
                            "numero",
                            "codigo_localidad",
                            "domicilio",
                            "telefono",
                            "email",
                            "codigo_postal"
                        ];
    //public $timestamps = false;
    //*******belongsTo */
    public function localidad(): BelongsTo
    {
        return $this->belongsTo(Localidad::class);
    }
    public function ambito(): BelongsTo
    {
        return $this->belongsTo(Ambito::class);
    }
    public function dependencia(): BelongsTo
    {
        return $this->belongsTo(Dependencia::class);
    }
    public function sector(): BelongsTo
    {
        return $this->belongsTo(Sector::class);
    }

    //********hasMany */
    public function inscripcionProcedencias(): HasMany
    {
        return $this->hasMany(Inscripcion::class);
    }
    public function inscripcionPases(): HasMany
    {
        return $this->hasMany(InscripcionPase::class);
    }
    public function legajos(): HasMany
    {
      return $this->hasMany(Legajo::class);
    }
    public function propuestas(): HasMany
    {
      return $this->hasMany(Propuesta::class);
    }

    //********belongsToMany/
    //public function propuestas(): BelongsToMany
    //{
    //    return $this->belongsToMany(Propuesta::class);
    //}
//        return $this->belongsToMany(Usuario::class, "usuario_escuela", "escuela_id", "usuario_id")
    public function usuarios(): BelongsToMany
    {
        return $this->belongsToMany(Usuario::class)
                    ->withPivot(['usuario_tipo_id', 'verified_at']);
    }
    public function modalidadesNiveles(): BelongsToMany
    {
        // Laravel infiere el nombre de la tabla pivote y las claves foráneas.
        // Si no siguen la convención, se pueden especificar:
        // return $this->belongsToMany(ModalidadNivel::class, 'nombre_de_la_tabla', 'escuela_id', 'modalidad_nivel_id');
        return $this->belongsToMany(ModalidadNivel::class)
                    ->using(EscuelaModalidadNivel::class);
    }
    public function ofertas(): BelongsToMany
    {
        return $this->belongsToMany(Oferta::class);
    }
}
