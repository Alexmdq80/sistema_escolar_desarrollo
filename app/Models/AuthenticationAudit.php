<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class AuthenticationAudit extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     *
     */
    protected $table = 'authentication_audits'; // ¡Asegúrate que sea el nombre correcto de tu tabla!

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */

    protected $fillable = [
        'auditable_type',
        'auditable_id',
        'event',
        'attempted_email',
        'url',
        'ip_address',
        'user_agent',
        'tags',
        'details',
        'audit_driver',
    ];

    protected $casts = [
        'old_values' => 'array', // Castear a array
        'new_values' => 'array', // Castear a array
        'tags' => 'array',       // Si 'tags' también es un array, cásatalo
        'details' => 'array'
    ];
}
