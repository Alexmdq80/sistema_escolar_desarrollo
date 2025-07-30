<?php

namespace App\Listeners;

use App\Events\EmailVerifiedAction; // <-- ¡Importa tu nuevo evento!
use App\Models\AuthenticationAudit;
use Illuminate\Support\Facades\Log;

class LogEmailVerifiedAction
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        // No necesitamos inyectar Request aquí, el evento ya trae la IP y User-Agent
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\EmailVerifiedAction  $event
     * @return void
     */
    public function handle(EmailVerifiedAction $event)
    {
        try {
            AuthenticationAudit::create([
                'auditable_type'  => 'App\Models\User',
                'auditable_id'    => $event->user->id,
                'event'           => 'email_verified', // Tipo de evento en tu tabla
                'ip_address'      => $event->ipAddress,
                'user_agent'      => $event->userAgent,
                'attempted_email' => $event->user->email, // El email que fue verificado
                'url'             => request()->fullUrl(), // La URL de la solicitud de verificación
                'details'         => [
                    'source' => $event->source, // Fuente de la verificación
                ],
                'tags'            => [
                    'status' => 'success',
                    'category' => 'email_verification',
                ],
                'audit_driver'    => null,
            ]);
        } catch (\Exception $e) {
            Log::error("Error al auditar la acción de verificación de email: " . $e->getMessage(), [
                'user_id' => $event->user->id,
                'email' => $event->user->email,
                'ip_address' => $event->ipAddress,
            ]);
        }
    }
}
