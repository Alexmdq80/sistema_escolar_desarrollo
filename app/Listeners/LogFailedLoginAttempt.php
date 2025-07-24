<?php

namespace App\Listeners;

use App\Models\AuthenticationAudit;

use Illuminate\Auth\Events\Failed;
use Illuminate\Support\Facades\Log;
use App\Models\User;

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
        $user_id = null;
        $auditable_type = null;
        $auditable_id = null;
        $emailAttempt = null;

        // --- Lógica correcta para obtener el email (SOLO DE LAS C REDENCIALES) ---
        // Este es el lugar correcto y esperado.
        // en $event->user['email'] siempre va a estar la credencial, sea
        // correcta o no.
        $emailAttempt =  $event->user['email'];;

       /* if (is_array($event->credentials) && isset($event->credentials['email'])) {
            $emailAttempt = $event->credentials['email'];
        } else {
            // Este log de error se disparará si $event->credentials no es un array con 'email'.
            // En un sistema correcto, esto significaría que el evento no se despachó con 'email'
            // en las credenciales, o que las credenciales no eran un array.
            Log::error('Failed login listener: Credentials data is not in expected array format or missing "email" key.', [
                'event_credentials_data' => $event->credentials,
                'event_credentials_type' => gettype($event->credentials),
            ]);
        }*/
       // --- FIN Lógica correcta para obtener el email ---
     
       //buscar en la BD, porque el evento Failed no me pasa nunce modelo
       //por alguna falla que no puedo hallar. 
       // es redundante, pero funciona
        $user = User::where('email', $emailAttempt)->first();
        //if ($event->user instanceof User) {
        if ($user instanceof User) {
            // si es un usuario, entonces obtenemos sus datos
      //      $user_id = $event->user->id;
      //      $auditable_type = get_class($event->user);
      //      $auditable_id = $event->user->id;
      //      $emailAttempt =  $event->user->email;
            $user_id = $user->id;
            $auditable_type = get_class($user);
            $auditable_id = $user->id;   
        } /*else {
           // Este warning es correcto para cuando $event->user es null (usuario no encontrado)
            // o si el usuario existía pero no es una instancia de App\Models\User.
            Log::warning('Failed login event: User object not an instance of App\Models\User or is null (as expected for failed credentials).', [
                'user_data_received' => $event->user,
                'type_received' => gettype($event->user),
            ]);
            $emailAttempt = $event->user['email'];
        }*/
        // --- ACCESO SEGURO A $event->exception (como en la solución anterior) ---
        // esto no sirve para nada, porque el evento Failed no tiene una propiedad 'exception'
        $exceptionMessage = null;
        $eventProperties = (array) $event;

        if (isset($eventProperties['exception']) && $eventProperties['exception'] instanceof \Throwable) {
             $exceptionMessage = $eventProperties['exception']->getMessage();
        }
        // --- FIN ACCESO SEGURO ---


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
                'guard' => $event->credentials,
                'exception' => $exceptionMessage,

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
