<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Failed;
use OwenIt\Auditing\Models\Audit;

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
        $auditable_type = 'App\\Models\\User'; // Valor por defecto si no hay usuario

        // Verifica si $event->user es una instancia de App\Models\User
        // (que debería ser si el usuario fue encontrado pero la contraseña era incorrecta)
        if ($event->user instanceof \App\Models\User) {
            $user_id = $event->user->id;
            $auditable_type = get_class($event->user);
        }
        // Si $event->user es null (usuario no encontrado), user_id ya es null.
        // Si fuera un array (lo cual es inesperado para este evento), el 'if' no entraría.


        $user_id = $event->user ? $event->user->id : null; // Podría ser null si el usuario no existe
        $auditable_type = $event->user ? get_class($event->user) : 'App\\Models\\User'; // O el modelo que esperas

        Audit::create([
            'auditable_type' => $auditable_type,
            'auditable_id' => $user_id,
            'event' => 'failed_login',
            'user_id' => $user_id,
            'url' => request()->fullUrl(),
            'ip_address' => request()->ip(),
            'user_agent' => request()->header('User-Agent'),
            'old_values' => ['email_attempt' => $event->credentials['email'] ?? 'N/A'],
            'new_values' => [],
            'tags' => ['authentication', 'failed_attempt'],
            'audit_driver' => 'authentication', // <-- ¡Ajuste aquí!
        ]);
    }
}