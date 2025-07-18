<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Failed;
use OwenIt\Auditing\Models\Audit;
use Illuminate\Support\Facades\Log;

class LogFailedLoginAttempt
{
    /**
     * Handle the event.
     *
     * @param  Failed  $event
     * @return void
     */
    public function handle(Failed $event)
    {
        // Depuración: Añade un dd() para ver qué contiene $event->user
        // dd($event->user, gettype($event->user), $event->credentials);
        $user_id = null;
        $auditable_type = null; // Inicializar a null

        // Si el usuario existe (contraseña incorrecta)
        if ($event->user instanceof User) {
            $user_id = $event->user->id;
            $auditable_type = get_class($event->user);
        } else {
            // Este log se activará si $event->user no es un objeto User
            // lo cual es esperable si el email no existe.
            Log::warning('Failed login event: User object not an instance of App\Models\User or is null.', [
                'user_data_received' => $event->user,
                'type_received' => gettype($event->user),
                'credentials_attempted' => $event->credentials,
                'guard_received' => $event->guard ?? 'N/A'
            ]);
        }

        // --- ¡CAMBIO CRÍTICO AQUÍ! ---
        $emailAttempt = 'N/A';
        if (is_array($event->credentials) && isset($event->credentials['email'])) {
            $emailAttempt = $event->credentials['email'];
        } elseif (is_string($event->credentials)) {
            // Si credentials es un string (como 'sanctum'), puedes registrarlo así
            $emailAttempt = 'Guard: ' . $event->credentials;
        }
        // -----------------------------

        // Prepara los datos para la auditoría
        $auditData = [
            'auditable_type' => $auditable_type, // Será null si el usuario no fue encontrado
            'auditable_id' => $user_id,         // Será null si el usuario no fue encontrado
            'event' => 'failed_login',
            'user_id' => $user_id,              // Será null si el usuario no fue encontrado
            'url' => request()->fullUrl(),
            'ip_address' => request()->ip(),
            'user_agent' => request()->header('User-Agent'),
            'old_values' => json_encode(['email_attempt' => $emailAttempt]),
            'new_values' => json_encode([]), 
            'tags' => implode(',', ['authentication', 'failed_attempt']), // <-- ¡CORREGIDO A STRING!
            'audit_driver' => 'authentication',
        ];

        //dd($auditData); // Puedes poner un dd() aquí para ver los datos finales antes de crear.

        Audit::create($auditData);
    }
}