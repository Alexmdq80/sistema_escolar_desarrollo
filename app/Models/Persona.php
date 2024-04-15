<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    use HasFactory;
    protected $table = "persona";
/*     protected $fillable = ["id_documento_tipo","documento_numero","apellido","nombre","tramite",
                            "posee_cpi_si","posee_docExt_si","vive_si","CUIL_prefijo","CUIL_sufijo",
                            "id_documento_situacion","id_sexo","id_genero","nacionalidad_id_pais",
                            "nacimiento_lugar_id_pais","nacimiento_lugar_id_provincia",
                            "nacimiento_lugar_id_departamento","nacimiento_lugar_localidad_asentamiento",
                            "nacimiento_fecha"]; */
                            
  /*  public $timestamps = false; */
}
