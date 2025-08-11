<?php

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Models\Usuario; // Importa tu modelo Usuario
use Illuminate\Http\Request; // Para capturar IP y User-Agent

class EmailVerifiedAction
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $usuario;
    public $ipAddress;
    public $userAgent;
    public $source; // Para indicar cómo se verificó (ej. 'verification_link')

    /**
     * Create a new event instance.
     *
     * @param  \App\Models\Usuario  $user  El usuario que verificó su email.
     * @param  string  $source  La fuente de la verificación (ej. 'verification_link').
     * @return void
     */
    public function __construct(Usuario $usuario, string $source = 'verification_link')
    {
        $this->usuario = $usuario;
        $this->source = $source;

        // Captura la IP y el User-Agent en el momento en que se dispara el evento
        $request = app(Request::class);
        $this->ipAddress = $request->ip();
        $this->userAgent = $request->header('User-Agent');
    }
}
