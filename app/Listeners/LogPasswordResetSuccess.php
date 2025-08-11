<?php

namespace App\Listeners;

use Illuminate\Auth\Events\PasswordReset;
use App\Models\AuthenticationAudit;
use Illuminate\Http\Request; // Para obtener la IP y User-Agent
use Illuminate\Support\Facades\Log;

class LogPasswordResetSuccess
{
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Handle the event.
     *
     * @param  \Illuminate\Auth\Events\PasswordReset  $event
     * @return void
     */
    public function handle(PasswordReset $event)
    {
        try {
            AuthenticationAudit::create([
                'auditable_type'  => 'App\Models\Usuario',
                'auditable_id'    => $event->user->id,
                'event'           => 'password_reset_success', // Tipo de evento para tu auditoría
                'ip_address'      => $this->request->ip(),
                'user_agent'      => $this->request->header('User-Agent'),
                'attempted_email' => $event->user->email, // El email del usuario cuya contraseña fue restablecida
                'url'             => $this->request->fullUrl(),
                'details'         => ['source' => 'forgot_password_flow'], // Indica que viene del flujo de "olvidé mi contraseña"
                'tags'            => [
                    'status' => 'success',
                    'notice' => 'security_alert',
                    'category' => 'password_change',
                ],
                'audit_driver'    => null,
            ]);
        } catch (\Exception $e) {
            Log::error("Error al auditar restablecimiento de contraseña: " . $e->getMessage(), [
                'usuario_id' => $event->user->id,
                'email' => $event->user->email,
                'ip_address' => $this->request->ip(),
            ]);
        }
    }
}
