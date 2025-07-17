<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Logout;
use OwenIt\Auditing\Models\Audit;

class LogSuccessfulLogout
{
    /**
     * Handle the event.
     *
     * @param  Logout  $event
     * @return void
     */
    public function handle(Logout $event)
    {
        if ($event->user) { // Asegúrate de que haya un usuario para auditar
            Audit::create([
                'auditable_type' => get_class($event->user),
                'auditable_id' => $event->user->id,
                'event' => 'logout',
                'user_id' => $event->user->id,
                'url' => request()->fullUrl(),
                'ip_address' => request()->ip(),
                'user_agent' => request()->header('User-Agent'),
                'tags' => ['authentication', 'logout'],
                'audit_driver' => 'authentication', // <-- ¡Ajuste aquí!
            ]);
        }
    }
}