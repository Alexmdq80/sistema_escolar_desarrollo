<?php

namespace App\Listeners;

use App\Events\EmailVerificationLinkSent; // <-- ¡Importa tu evento personalizado!
use App\Models\AuthenticationAudit;
use Illuminate\Support\Facades\Log;

class LogEmailVerificationSent
{
    protected $request;

    public function __construct()
    {

    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\EmailVerificationLinkSent  $event
     * @return void
     */
    public function handle(EmailVerificationLinkSent $event)
    {
        //\Log::error("Pasó por LogEmailVerificationSent...");
        try {
            AuthenticationAudit::create([
                'auditable_type'  => 'App\Models\User',
                'auditable_id'    => $event->user->id,
                'event'           => 'email_verification_sent',
                'ip_address'      => $event->ipAddress,
                'user_agent'      => $event->userAgent,
                'attempted_email' => $event->email,
                'url'             => request()->fullUrl(), // Captura la URL actual si es relevante
                'tags'            => ['status' => 'success', 'source' => $event->source],
            ]);
        } catch (\Exception $e) {
            // Es crucial que la auditoría no rompa el flujo principal de la aplicación.
            // Registra el error pero permite que la aplicación continúe.
            \Log::error("Error al auditar el envío de email de verificación (Evento Personalizado): " . $e->getMessage(), [
                'user_id' => $event->user->id,
                'email' => $event->email,
                'ip_address' => $event->ipAddress,
            ]);
        }

    }
}
