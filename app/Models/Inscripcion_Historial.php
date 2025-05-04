<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class inscripcion_historial extends Model
{
    protected $table = "inscripcion_historial";
    use HasFactory;

    public function finalizado() {
        return $this->hasOne(Inscripcion_Finalizado::class, 'id_inscripcion_historial');
    }

}
