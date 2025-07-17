<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Login;
use OwenIt\Auditing\Models\Audit;

class LogSuccessfulLogin
{
    public function handle(Login $event)
    {
        // Verificamos si $event->user es una instancia de un objeto (debe ser el modelo User)
        if (! $event->user instanceof \App\Models\User) {
            // Si no es un usuario válido, no podemos auditar.
            // Podrías registrar un error aquí si esto no debería pasar.
            \Log::error('Login event fired without a valid user object.', ['user_data' => $event->user]);
            return; // Detenemos la ejecución del Listener
        }

        // Si llegamos aquí, $event->user es un objeto App\Models\User
        Audit::create([
            'auditable_type' => get_class($event->user), // Ahora esto será seguro
            'auditable_id' => $event->user->id,
            'event' => 'login',
            'user_id' => $event->user->id,
            'url' => request()->fullUrl(),
            'ip_address' => request()->ip(),
            'user_agent' => request()->header('User-Agent'),
            'tags' => ['authentication', 'login'],
            'audit_driver' => 'authentication',
        ]);
    }
}