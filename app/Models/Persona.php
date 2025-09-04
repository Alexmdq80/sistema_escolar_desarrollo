<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Persona extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ["documento_tipo_id",
                          "documento_situacion_id",
                          "sexo_id",
                          "genero_id",
                          "nacionalidad_nacion_id", 
                          "nacion_id",
                          "provincia_id",
                          "departamento_id",
                          "localidad_id",
                          "documento_numero",
                          "apellido",
                          "nombre",
                          "nombre_alternativo",
                          "tramite",
                          "posee_cpi_si",
                          "posee_docExt_si",
                          "vive_si",
                          "CUIL_prefijo",
                          "CUIL_sufijo",
                          "nacimiento_fecha"
                        ];

    protected $casts = [
       'nacimiento_fecha' => 'datetime'
    ];

    public function documentoTipo(): BelongsTo
    {
      return $this->belongsTo(DocumentoTipo::class);
    }
    public function documentoSituacion(): BelongsTo
    {
      return $this->belongsTo(DocumentoSituacion::class);
    }
    public function sexo(): BelongsTo
    {
      return $this->belongsTo(Sexo::class);
    }
    public function genero(): BelongsTo
    {
      return $this->belongsTo(Genero::class);
    }
    public function nacionalidad(): BelongsTo
    {
      return $this->belongsTo(Nacion::class, "nacionalidad_nacion_id");
    }
    public function nacimientoPais(): BelongsTo
    {
      return $this->belongsTo(Nacion::class);
    }
    public function nacimientoProvincia(): BelongsTo
    {
      return $this->belongsTo(Provincia::class);
    }
    public function nacimientoDepartamento(): BelongsTo
    {
      return $this->belongsTo(Departamento::class);
    }
    public function nacimientoLocalidad(): BelongsTo
    {
      return $this->belongsTo(Localidad::class);
    }
    public function domicilio(): HasOne
    {
      return $this->hasOne(Domicilio::class);
    }
    public function contacto(): HasOne
    {
      return $this->hasOne(Contacto::class);
    }
    public function inscripcion(): HasOne
    {
      return $this->hasOne(Inscripcion::class);
    }
    public function legajos(): HasMany
    {
      return $this->HasMany(Legajo::class);
    }
    public function vinculosComoEstudiante(): BelongsToMany
    {
        return $this->belongsToMany(Persona::class, 'persona_vinculo_persona', 'persona_estudiante_id', 'persona_adulto_id')
                    ->using(PersonaVinculoPersona::class)
                    ->withPivot('vinculo_id');
    }
    /**
     * Los vínculos de esta persona como adulto.
     */
    public function vinculosComoAdulto(): BelongsToMany
    {
        return $this->belongsToMany(Persona::class, 'persona_vinculo_persona', 'persona_adulto_id', 'persona_estudiante_id')
                    ->using(PersonaVinculoPersona::class)
                    ->withPivot('vinculo_id');
    }


 }
