<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inscripcion extends Model
{
    use HasFactory;

    protected $table = "inscripcion";

    protected $fillable = ["id_persona","id_firma","id_espacio_academico",
        "id_escuela_procedencia","id_escuela_destino","id_nivel_procedencia",
        "id_modalidad_procedencia","id_condicion","codigo_abc","proyecto_inclusion_si",
        "concurre_especial_si","asistente_externo_si","fecha"];

    public function persona() {
        return $this->belongsTo(Persona::class, "id_persona", "id");
    }
    public function persona_firma() {
        return $this->belongsTo(Persona::class, "id_persona_firma", "id");
    }
    public function espacio_academico() {
        return $this->belongsTo(Espacio_Academico::class, "id_espacio_academico", "id");
    }
    public function escuela_procedencia() {
        return $this->belongsTo(Escuela::class, "id_escuela_procedencia", "id");
    }
    public function escuela_destino() {
        return $this->belongsTo(Escuela::class, "id_escuela_destino", "id");
    }
    public function nivel_procedencia() {
        return $this->belongsTo(Escuela::class, "id_nivel_procedencia", "id");
    }
    public function modalidad_procedencia() {
        return $this->belongsTo(Modalidad::class, "id_modalidad_procedencia", "id");
    }
    public function condicion() {
        return $this->belongsTo(Condicion::class, "id_condicion", "id");
    }



}
