<?php

namespace App\Models;

use OwenIt\Auditing\Models\Audit as BaseAudit; // Importa el modelo base de auditoría

class AuthenticationAudit extends BaseAudit
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
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
