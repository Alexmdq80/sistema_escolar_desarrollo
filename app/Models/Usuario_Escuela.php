<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuario_Escuela extends Model
{
    use HasFactory;

    protected $table = "usuario_escuela";

    protected $fillable = ["id_escuela","id_usuario","verificado"];

    public $timestamps = false;

    public function escuela(){
        return $this->belongsTo(Escuela::class, "id_escuela");
    }
    public function usuario(){
        return $this->belongsTo(User::class, "id_usuario");
    }
    public function usuarioTipo(){
        return $this->belongsTo(Usuario_Tipo::class, "id_usuario_tipo");
    }

}
