<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuario_Tipo extends Model
{
    // use HasFactory;
    protected $table = "usuario_tipo";
    protected $fillable = ["nombre","orden","vigente"];

    public function usuarioEscuela(){
        return $this->hasMany(Usuario_Escuela::class,"id_usuario_tipo","id");
    }


}
