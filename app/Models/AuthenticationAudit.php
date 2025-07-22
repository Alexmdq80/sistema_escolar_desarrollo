<?php

namespace App\Models;

use OwenIt\Auditing\Models\Audit as BaseAudit; // Importa el modelo base de auditoría
//use OwenIt\Auditing\Auditable; // Importa el trait
//use OwenIt\Auditing\Contracts\Auditable as AuditableContract; // Importa el contrato (necesario)

//class AuthenticationAudit extends BaseAudit implements AuditableContract
class AuthenticationAudit extends BaseAudit
{
    /**
     * The table associated with the model.
     *
     * @var string
     *
     */
//    use Auditable;

   // protected $auditDriver = 'authentication';

    protected $table = 'authentication_audits'; // ¡Asegúrate que sea el nombre correcto de tu tabla!

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'old_values' => 'array', // Castear a array
        'new_values' => 'array', // Castear a array
        //'tags' => 'array',       // Si 'tags' también es un array, cásatalo
    ];
}
