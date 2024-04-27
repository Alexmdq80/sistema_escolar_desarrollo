<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    use HasFactory;
    protected $table = "persona";
    protected $fillable = ["id_documento_tipo","id_documento_situacion","id_sexo","id_genero",
                          "nacionalidad_id_pais", "nacimiento_lugar_id_pais","nacimiento_lugar_id_provincia",
                          "nacimiento_lugar_id_departamento","nacimiento_lugar_localidad_asentamiento",
                          "documento_numero","apellido","nombre","nombre_alternativo","tramite",
                          "posee_cpi_si","posee_docExt_si","vive_si","CUIL_prefijo","CUIL_sufijo",
                          "nacimiento_fecha"];

    public function documento_tipo() {
      return $this->belongsTo(Documento_Tipo::class, "id_documento_tipo");
    }
    public function documento_situacion() {
      return $this->belongsTo(Documento_Situacion::class, "id_documento_situacion");
    }
    public function sexo() {
      return $this->belongsTo(Sexo::class, "id_sexo");
    }
    public function genero() {
      return $this->belongsTo(Genero::class, "id_genero");
    }
    public function nacionalidad() {
      return $this->belongsTo(Pais::class, "nacionalidad_id_pais");
    }
    public function nacimiento_pais() {
      return $this->belongsTo(Pais::class, "nacimiento_lugar_id_pais");
    }
    public function nacimiento_provincia() {
      return $this->belongsTo(Provincia::class, "nacimiento_lugar_id_provincia");
    }
    public function nacimiento_departamento() {
      return $this->belongsTo(Departamento::class, "nacimiento_lugar_id_departamento");
    }
    public function nacimiento_localidad_asentamiento() {
      return $this->belongsTo(Localidad_Asentamiento::class, "nacimiento_lugar_id_localidad_asentamiento");
    }
    public function domicilo(){
      return $this->hasOne(Domicilio::class,"id_persona","id");
    }
    public function usuario(){
      return $this->hasOne(Usuario::class,"id_persona","id");
    }
    public function inscripciones(){
      return $this->hasMany(Inscripcion::class,"id_persona","id");
  }


}
