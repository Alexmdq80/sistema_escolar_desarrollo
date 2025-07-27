<?php

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Models\User; // Importa tu modelo User
use Illuminate\Http\Request; // Para capturar IP y User-Agent en el momento del evento

class EmailVerificationLinkSent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $user;
    public $email;
    public $ipAddress;
    public $userAgent;
    public $source; // Para indicar de dónde viene la solicitud (ej. 'registration', 'resend', 'email_change')

    /**
     * Create a new event instance.
     *
     * @param  \App\Models\User  $user
     * @param  string  $email  La dirección de email a la que se envió el enlace.
     * @param  string  $source  La fuente de la solicitud (ej. 'registration', 'resend').
     * @return void
     */
    public function __construct(User $user, string $email, string $source)
    {
        //\Log::error("Pasó por EmailVerificationLinkSent...");

        $this->user = $user;
        $this->email = $email;
        $this->source = $source;

        // Captura la IP y el User-Agent en el momento en que se dispara el evento
        $request = app(Request::class);
        $this->ipAddress = $request->ip();
        $this->userAgent = $request->header('User-Agent');
    }
}
