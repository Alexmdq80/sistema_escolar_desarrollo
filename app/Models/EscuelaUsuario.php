<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Auditable; // Importa el trait
use OwenIt\Auditing\Contracts\Auditable as AuditableContract; // Importa el contrato (necesario)
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
class EscuelaUsuario  extends Model implements AuditableContract
{
    use SoftDeletes, Auditable, HasUuids;

    protected $table = "usuario_escuela";

    protected $fillable = ["id_escuela","usuario_id","verified_at","id_usuario_tipo"];

    public $timestamps = true;

    protected $casts = [
       'verified_at' => 'datetime'
    ];

    public function escuela(){
        return $this->belongsTo(Escuela::class, "id_escuela");
    }
    public function usuario(){
        return $this->belongsTo(Usuario::class, "usuario_id");
    }
    public function usuarioTipo(){
        return $this->belongsTo(UsuarioTipo::class, "id_usuario_tipo");
    }

}
