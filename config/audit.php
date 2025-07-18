<?php

return [

    'enabled' => env('AUDITING_ENABLED', true),

    /*
    |--------------------------------------------------------------------------
    | Audit Implementation
    |--------------------------------------------------------------------------
    |
    | Define which Audit model implementation should be used.
    |
    */

    'implementation' => OwenIt\Auditing\Models\Audit::class, // Usamos el modelo base por ahora,
                                                              // ya que los casts no eran el problema final.

    /*
    |--------------------------------------------------------------------------
    | User Morph prefix & Guards
    |--------------------------------------------------------------------------
    |
    | Define the morph prefix and authentication guards for the User resolver.
    |
    */

    'user' => [
        'morph_prefix' => 'user',
        'guards' => [
            'web',
            'api',
        ],
        'resolver' => OwenIt\Auditing\Resolvers\UserResolver::class,
    ],

    /*
    |--------------------------------------------------------------------------
    | Audit Resolvers
    |--------------------------------------------------------------------------
    |
    | Define the IP Address, User Agent and URL resolver implementations.
    |
    */
    'resolvers' => [
        'ip_address' => OwenIt\Auditing\Resolvers\IpAddressResolver::class,
        'user_agent' => OwenIt\Auditing\Resolvers\UserAgentResolver::class,
        'url' => OwenIt\Auditing\Resolvers\UrlResolver::class,
    ],

    /*
    |--------------------------------------------------------------------------
    | Audit Event Mapping (GLOBAL)
    |--------------------------------------------------------------------------
    |
    | Here you may configure which events should use a specific audit driver.
    | This section maps events (like Laravel's Auth events) to audit drivers.
    | If an event is not mapped here, it will fall back to the default driver.
    |
    */
    'events' => [
        // Eventos de Eloquent (para auditar cambios en modelos que usan HasAuditableTrait)
        'created',
        'updated',
        'deleted',
        'restored',
        // Mapeo explícito de los eventos de autenticación a tu driver 'authentication'
        \Illuminate\Auth\Events\Failed::class => 'authentication',
        \Illuminate\Auth\Events\Login::class => 'authentication',
        \Illuminate\Auth\Events\Logout::class => 'authentication', // Si auditas el logout
    ],

    /*
    |--------------------------------------------------------------------------
    | Strict Mode
    |--------------------------------------------------------------------------
    |
    | Enable the strict mode when auditing?
    |
    */

    'strict' => false,

    /*
    |--------------------------------------------------------------------------
    | Global exclude
    |--------------------------------------------------------------------------
    |
    | Have something you always want to exclude by default? - add it here.
    | Note that this is overwritten (not merged) with local exclude
    |
    */

    'exclude' => [],

    /*
    |--------------------------------------------------------------------------
    | Empty Values
    |--------------------------------------------------------------------------
    |
    | Should Audit records be stored when the recorded old_values & new_values
    | are both empty?
    |
    | Some events may be empty on purpose. Use allowed_empty_values to exclude
    | those from the empty values check. For example when auditing
    | model retrieved events which will never have new and old values.
    |
    |
    */

    'empty_values' => true,
    'allowed_empty_values' => [
        'retrieved',
    ],

    /*
    |--------------------------------------------------------------------------
    | Allowed Array Values
    |--------------------------------------------------------------------------
    |
    | Should the array values be audited?
    |
    | By default, array values are not allowed. This is to prevent performance
    | issues when storing large amounts of data. You can override this by
    | setting allow_array_values to true.
    */
    'allowed_array_values' => false,

    /*
    |--------------------------------------------------------------------------
    | Audit Timestamps
    |--------------------------------------------------------------------------
    |
    | Should the created_at, updated_at and deleted_at timestamps be audited?
    |
    */

    'timestamps' => false,

    /*
    |--------------------------------------------------------------------------
    | Audit Threshold
    |--------------------------------------------------------------------------
    |
    | Specify a threshold for the amount of Audit records a model can have.
    | Zero means no limit.
    |
    */

    'threshold' => 0,

    /*
    |--------------------------------------------------------------------------
    | Audit Drivers (CONSOLIDATED AND CORRECTED)
    |--------------------------------------------------------------------------
    |
    | Define your audit drivers here. The 'database' driver is the default,
    | but you can specify others like 'authentication' for specific events.
    |
    */

    'drivers' => [
        'database' => [
            'table'      => 'audits', // Tabla por defecto para auditorías generales de modelos
            'connection' => null,
        ],
        'authentication' => [
            'table'      => 'authentication_audits', // Tu tabla personalizada para autenticación
            'model'      => OwenIt\Auditing\Models\Audit::class, // Usa el modelo base de auditing
            'enabled'    => true,
            'strict'     => false,
            'events'     => null, // Esto es 'null' aquí porque los eventos se mapean globalmente arriba
            'limits'     => true,
            'excludes'   => [],
            'resolves'   => [],
            'relations'  => [
                'enabled' => false,
                'audit'   => [],
            ],
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Audit Queue Configurations
    |--------------------------------------------------------------------------
    |
    | Available audit queue configurations.
    |
    */

    'queue' => [
        'enable' => false,
        'connection' => 'sync',
        'queue' => 'default',
        'delay' => 0,
    ],

    /*
    |--------------------------------------------------------------------------
    | Audit Console
    |--------------------------------------------------------------------------
    |
    | Whether console events should be audited (eg. php artisan db:seed).
    |
    */

    'console' => false,

    'sensitive_fields' => [
        'password',
        'remember_token',
        // Otros campos que consideres sensibles y no deban auditarse nunca
    ],
];