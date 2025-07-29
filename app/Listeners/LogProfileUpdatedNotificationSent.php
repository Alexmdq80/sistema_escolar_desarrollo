<?php

namespace App\Listeners;

use App\Events\ProfileUpdatedNotificationSent; // Tu evento personalizado
use App\Models\AuthenticationAudit;
use Illuminate\Support\Facades\Log;

class LogProfileUpdatedNotificationSent
{
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\ProfileUpdatedNotificationSent  $event
     * @return void
     */
    public function handle(ProfileUpdatedNotificationSent $event)
    {
            // Solo agrega el nombre si ha cambiado
            if (($event->oldData['nombre'] ?? '') !== ($event->newData['nombre'] ?? '')) {
                $details['old_nombre'] = $event->oldData['nombre'] ?? '';
                $details['new_nombre'] = $event->newData['nombre'] ?? '';
            }

            // Solo agrega el apellido si ha cambiado
            if (($event->oldData['apellido'] ?? '') !== ($event->newData['apellido'] ?? '')) {
                $details['old_apellido'] = $event->oldData['apellido'] ?? '';
                $details['new_apellido'] = $event->newData['apellido'] ?? '';
            }

        try {
            AuthenticationAudit::create([
                'auditable_type'  => 'App\Models\User',
                'auditable_id'    => $event->user->id,
                'event'           => 'profile_update_notification_sent', // Tipo de evento para tu auditoría
                'ip_address'      => $event->ipAddress,
                'user_agent'      => $event->userAgent,
                'attempted_email' => $event->notifiedEmail, // El email al que se envió la notificación
                'url'             => request()->fullUrl(),
                'old_values'      => null,
                'new_values'      => null,
                'details'         => $details,
                'tags'            => ['status' => 'success', 'notice' => 'security_alert', 'warning' => 'profile_update'],
                'audit_driver'    => null,
            ]);
        } catch (\Exception $e) {
            Log::error("Error al auditar el envío de notificación de actualización de perfil: " . $e->getMessage(), [
                'user_id' => $event->user->id,
                'email' => $event->notifiedEmail,
                'ip_address' => $event->ipAddress,
            ]);
        }
    }
}
