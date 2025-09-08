<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
//use Illuminate\Database\Eloquent\SoftDeletes;

class Inscripcion extends Model
{
    use HasFactory, HasUuids;
    //, SoftDeletes

    protected $fillable = ["persona_id", "persona_firma_id","espacio_id",
                            "escuela_id","nivel_id","modalidad_id",
                            "condicion_id",
                            "persona_vinculo_persona_1_id",
                            "persona_vinculo_persona_2_id",
                            "persona_vinculo_persona_3_id",
                            "codigo_abc","proyecto_inclusion_si",
                            "concurre_especial_si",
                            "asistente_externo_si",
                            "fecha"
                        ];

    protected $casts = [
       'fecha' => 'datetime'
    ];

    public function persona(): BelongsTo {
        return $this->belongsTo(Persona::class);
    }
    public function personaFirma(): BelongsTo {
        return $this->belongsTo(Persona::class, "persona_firma_id","id");
    }
    public function espacio(): BelongsTo {
        return $this->belongsTo(Espacio::class);
    }
    public function escuelaProcedencia(): BelongsTo {
        return $this->belongsTo(Escuela::class);
    }
    public function nivelProcedencia(): BelongsTo {
        return $this->belongsTo(Nivel::class);
    }
    public function modalidadProcedencia(): BelongsTo {
        return $this->belongsTo(Modalidad::class);
    }
    public function condicion(): BelongsTo {
        return $this->belongsTo(Condicion::class);
    }
    public function vinculoPersona_1(): BelongsTo {
        return $this->belongsTo(PersonaVinculoPersona::class,"persona_vinculo_persona_1_id","id");
    }
    public function vinculoPersona_2(): BelongsTo {
        return $this->belongsTo(PersonaVinculoPersona::class,"persona_vinculo_persona_2_id","id");
    }
    public function vinculoPersona_3(): BelongsTo {
        return $this->belongsTo(PersonaVinculoPersona::class,"persona_vinculo_persona_3_id","id");
    }

}
