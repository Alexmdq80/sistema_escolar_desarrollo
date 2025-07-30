<?php

namespace App\Listeners;

use App\Events\PasswordResetRequested;
use App\Models\AuthenticationAudit;
use Illuminate\Support\Facades\Log;

class LogPasswordResetRequested
{
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\PasswordResetRequested  $event
     * @return void
     */
    public function handle(PasswordResetRequested $event)
    {
        try {
            AuthenticationAudit::create([
                'auditable_type'  => 'App\Models\User',
                'auditable_id'    => $event->user->id,
                'event'           => 'password_reset_requested', // Tipo de evento
                'ip_address'      => $event->ipAddress,
                'user_agent'      => $event->userAgent,
                'attempted_email' => $event->email, // El email al que se envió el enlace
                'url'             => request()->fullUrl(),
                'details'         => ['source' => 'forgot_password_flow'],
                'tags'            => ['status' => 'success', 'category' => 'password_reset'],
                'audit_driver'    => null,
            ]);
        } catch (\Exception $e) {
            Log::error("Error al auditar solicitud de restablecimiento de contraseña: " . $e->getMessage(), [
                'user_id' => $event->user->id,
                'email' => $event->email,
                'ip_address' => $event->ipAddress,
            ]);
        }
    }
}
