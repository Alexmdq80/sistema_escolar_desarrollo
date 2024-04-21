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
        "concurre_especial_si","asistente_externo_si","activo","pase","sinpase"];

    public function persona() {
        return $this->belongsTo(Persona::class, "id", "id_persona");
    }
    public function persona_firma() {
        return $this->belongsTo(Persona::class, "id", "id_firma");
    }
    public function espacio_academico() {
        return $this->belongsTo(Espacio_Academico::class, "id", "id_espacio_academico");
    }
    public function escuela_procedencia() {
        return $this->belongsTo(Escuela::class, "id", "id_escuela_procedencia");
    }
    public function escuela_destino() {
        return $this->belongsTo(Escuela::class, "id", "id_escuela_destino");
    }
    public function nivel_procedencia() {
        return $this->belongsTo(Escuela::class, "id", "id_nivel_procedencia");
    }
    public function modalidad_procedencia() {
        return $this->belongsTo(Modalidad::class, "id", "id_modalidad_procedencia");
    }
    public function condicion() {
        return $this->belongsTo(Condicion::class, "id", "id_condicion");
    }



}
