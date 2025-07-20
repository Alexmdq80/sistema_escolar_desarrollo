<?php

namespace App\Listeners;

use App\Models\AuthenticationAudit;

use Illuminate\Auth\Events\Failed;
// ELIMINAR ESTA LÍNEA: use OwenIt\Auditing\Models\Audit; este funciona, pero en tabla audits
use OwenIt\Auditing\Facades\Auditor; // <--- Esta es la Facade correcta a usar
use App\Models\User; // Asegúrate de que este 'use' esté presente si usas el modelo User
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Config; // <-- ¡Asegúrate de que esté aquí si vas a usar Config!


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
        // --- DIAGNÓSTICO TEMPORAL ---
        /* $auditDrivers = Config::get('audit.drivers');
            $authEventsMapping = Config::get('audit.events');

            Log::info('DEBUG: Configuración de drivers de auditoría:', $auditDrivers);
            Log::info('DEBUG: Mapeo de eventos de autenticación:', $authEventsMapping);
            // --- FIN DIAGNÓSTICO TEMPORAL ---*/
        Log::info('DEBUG AUTH AUDIT: Intentando crear auditoría.');
        Log::info('DEBUG AUTH AUDIT: Modelo de auditoría usado: ' . AuthenticationAudit::class);
        Log::info('DEBUG AUTH AUDIT: Tabla definida en modelo: ' . (new AuthenticationAudit())->getTable());
        //dd((new AuthenticationAudit())->getTable()); // Prueba esto si quieres detener la ejecución y ver la tabla


        $user_id = null;
        $auditable_type = null;

        if ($event->user instanceof User) {
            $user_id = $event->user->id;
            $auditable_type = get_class($event->user);
        } else {
            Log::warning('Failed login event: User object not an instance of App\Models\User or is null.', [
                'user_data_received' => $event->user,
                'type_received' => gettype($event->user),
                'credentials_attempted' => $event->credentials,
                'guard_received' => $event->guard ?? 'N/A'
            ]);
        }

        $emailAttempt = 'N/A';
        if (is_array($event->credentials) && isset($event->credentials['email'])) {
            $emailAttempt = $event->credentials['email'];
        } elseif (is_string($event->credentials)) {
            $emailAttempt = 'Guard: ' . $event->credentials;
        }

        // Prepara los datos para la auditoría
        $auditData = [
            'auditable_type' => $auditable_type,
            'auditable_id' => $user_id,
            'event' => 'failed_login',
            'user_id' => $user_id,
            'url' => request()->fullUrl(),
            'ip_address' => request()->ip(),
            'user_agent' => request()->header('User-Agent'),
            'old_values' => ['email_attempt' => $emailAttempt],
            'new_values' => [],
            'tags' => implode(',', ['authentication', 'failed_attempt']),
            // ELIMINAR ESTA LÍNEA (ES REDUNDANTE): 'audit_driver' => 'authentication',
          //  'audit_driver' => 'authentication', //volvemos a probar con esto

        ];

        //dd($auditData); // Puedes poner un dd() aquí para ver los datos finales antes de crear.

        // ¡ESTA ES LA LÍNEA CLAVE Y CORRECTA!
        //Auditor::driver('authentication')->create($auditData);
        //AuthenticationAudit::create($auditData);
       // Auditor::create($auditData);
        Auditor::driver('authentication')->create($auditData);

        // Si quieres usar el modelo directamente, puedes hacerlo así:
        // AuthenticationAudit::create($auditData); // Esto también funciona si el modelo está bien configurado
        // Auditor::driver('authentication')->create($auditData); // Esta es la forma correcta de usar Auditor con tu driver personalizado

    }
}
