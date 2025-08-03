<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsuarioTipo extends Model
{
    // use HasFactory;
    protected $table = "usuario_tipo";
    protected $fillable = ["nombre","orden","vigente"];

    public function usuarioEscuela(){
        return $this->hasMany(UsuarioEscuela::class,"id_usuario_tipo","id");
    }


}
