<?php

namespace App\Listeners;

use App\Events\ProfileUpdatedPasswordNotificationSent; // Tu evento personalizado
use App\Models\AuthenticationAudit;
use Illuminate\Support\Facades\Log;

class LogProfileUpdatedPasswordNotificationSent
{
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\ProfileUpdatedPasswordNotificationSent  $event
     * @return void
     */
    public function handle(ProfileUpdatedPasswordNotificationSent $event)
    {
        try {
            AuthenticationAudit::create([
                'auditable_type'  => 'App\Models\User',
                'auditable_id'    => $event->user->id,
                'event'           => 'password_change_notification_sent', // Tipo de evento para tu auditoría
                'ip_address'      => $event->ipAddress,
                'user_agent'      => $event->userAgent,
                'attempted_email' => $event->notifiedEmail, // El email al que se envió la notificación
                'url'             => request()->fullUrl(),
                'details'         => 'profile_settings',
                'tags'            => ['status' => 'success', 'notice' => 'security_alert', 'category' => 'password_change', 'source' => 'profile_update'],
                'audit_driver'    => null,
            ]);
        } catch (\Exception $e) {
            Log::error("Error al auditar el envío de notificación de actualización de password de perfil: " . $e->getMessage(), [
                'user_id' => $event->user->id,
                'email' => $event->notifiedEmail,
                'ip_address' => $event->ipAddress,
            ]);
        }
    }
}
