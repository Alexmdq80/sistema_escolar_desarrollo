<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inscripcion_Finalizado extends Model
{
    protected $table = "inscripcion_finalizado";
    protected $fillable = ["id_inscripcion_historial","id_condicion"];

   // use HasFactory;
    public $timestamps = false;

    public function inscripcion_historial(){
        return $this->belongsTo(Inscripcion_Historial::class, "id_inscripcion_historial");
    }

    public function condicion(){
        return $this->belongsTo(Condicion::class, "id_condicion");
    }
}
