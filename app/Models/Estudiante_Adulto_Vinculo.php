<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estudiante_Adulto_Vinculo extends Model
{
    use HasFactory;

    protected $table = "estudiante_adulto_vinculo";

    protected $fillable = ["detalle","vencimiento_fecha"];

    public function adulto_vinculo(){
        return $this->belongsTo(Adulto_Vinculo::class, "id_adulto_vinculo");
    }

}
