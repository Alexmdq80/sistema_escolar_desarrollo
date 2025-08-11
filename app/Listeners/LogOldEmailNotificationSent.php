<?php

namespace App\Listeners;

use App\Events\OldEmailNotificationSent; // Tu evento personalizado
use App\Models\AuthenticationAudit;

class LogOldEmailNotificationSent
{
    public function __construct()
    {
        //
    }

    public function handle(OldEmailNotificationSent $event)
    {
        try {
            AuthenticationAudit::create([
                'auditable_type'  => 'App\Models\Usuario',
                'auditable_id'    => $event->usuario->id,
                'event'           => 'email_change_notification_sent_old_email',
                'ip_address'      => $event->ipAddress,
                'user_agent'      => $event->userAgent,
                'attempted_email' => $event->oldEmail,
                'url'             => request()->fullUrl(), // Captura la URL actual si es relevante
                'tags'            => ['status' => 'success', 'source' => 'email_change', 'notice' => 'security_alert'],
                'details'         => ['new_email' => $event->newEmail],
            ]);
        } catch (\Exception $e) {
            // Es crucial que la auditoría no rompa el flujo principal de la aplicación.
            // Registra el error pero permite que la aplicación continúe.
            \Log::error("Error al auditar el envío de aviso a email viejo: " . $e->getMessage(), [
                'user_id' => $event->usuario->id,
                'old_email' => $event->oldEmail,
                'new_email' => $event->newEmail,
            ]);

        }
    }

}
