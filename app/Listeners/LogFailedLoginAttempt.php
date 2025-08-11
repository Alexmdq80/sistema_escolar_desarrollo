<?php

namespace App\Listeners;

use App\Models\AuthenticationAudit;

use Illuminate\Auth\Events\Failed;
use Illuminate\Support\Facades\Log;
use App\Models\Usuario;

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
        $usuario_id = null;
        $auditable_type = null;
        $auditable_id = null;
        $emailAttempt = null;

        $emailAttempt =  $event->credentials['email'];

        if ($event->user instanceof Usuario) {
            // si es un usuario, entonces obtenemos sus datos
            $usuario_id = $event->user->id;
            $auditable_type = get_class($event->user);
            $auditable_id = $event->user->id;
        }

       /* Log::error("Contenido del evento Failed en Listener", [
            'event_object' => $event, // Pass the entire event object
            'event_user_type' => gettype($event->user),
            'event_user_data' => $event->user,
            'event_credentials_type' => gettype($event->credentials),
            'event_credentials_data' => $event->credentials,
            'event_guard' => $event->guard,
            'event_exception' => property_exists($event, 'exception') ? (string) $event->exception : 'N/A',
        ]);*/

          // Prepare the data for auditing
        $auditData = [
            'auditable_type' => $auditable_type, // Will be null if user not found/invalid
            'auditable_id' => $auditable_id,     // Will be null if user not found/invalid
            'event' => 'failed_login',
            'url' => request()->fullUrl(),
            'ip_address' => request()->ip(),
            'user_agent' => request()->header('User-Agent'),
            'attempted_email' => $emailAttempt,
            'tags' => ['authentication', 'failed_attempt'],
            'audit_driver' => null,
            'details' => [ // Capture guard and exception message
                'guard' => $event->guard
                //'exception' => $exceptionMessage,
            ],
        ];

        try {
            AuthenticationAudit::create($auditData);
            Log::info('Failed login attempt audited successfully.', [
                'attempted_email' => $emailAttempt,
                'ip_address' => $auditData['ip_address'],
            ]);
        } catch (\Exception $e) {
            Log::error('Failed to save failed login audit record.', [
                'audit_data' => $auditData,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);
        }
    }
}
