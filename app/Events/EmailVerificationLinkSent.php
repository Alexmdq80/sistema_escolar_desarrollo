<?php

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Models\Usuario; // Importa tu modelo Usuario
use Illuminate\Http\Request; // Para capturar IP y User-Agent en el momento del evento

class EmailVerificationLinkSent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $usuario;
    public $email;
    public $ipAddress;
    public $userAgent;
    public $source; // Para indicar de dónde viene la solicitud (ej. 'registration', 'resend', 'email_change')

    /**
     * Create a new event instance.
     *
     * @param  \App\Models\Usuario  $usuario
     * @param  string  $email  La dirección de email a la que se envió el enlace.
     * @param  string  $source  La fuente de la solicitud (ej. 'registration', 'resend').
     * @return void
     */
    public function __construct(Usuario $usuario, string $email, string $source)
    {
        //\Log::error("Pasó por EmailVerificationLinkSent...");

        $this->usuario = $usuario;
        $this->email = $email;
        $this->source = $source;

        // Captura la IP y el User-Agent en el momento en que se dispara el evento
        $request = app(Request::class);
        $this->ipAddress = $request->ip();
        $this->userAgent = $request->header('User-Agent');
    }
}
