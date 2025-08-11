<?php

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Models\Usuario;
use Illuminate\Http\Request;

class PasswordResetRequested
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $usuario;
    public $email;
    public $ipAddress;
    public $userAgent;

    /**
     * Create a new event instance.
     *
     * @param  \App\Models\Usuario  $usuario  El usuario que solicitó el restablecimiento.
     * @param  string  $email  El email al que se envió el enlace.
     * @return void
     */
    public function __construct(Usuario $usuario, string $email)
    {
        $this->usuario = $usuario;
        $this->email = $email;

        $request = app(Request::class);
        $this->ipAddress = $request->ip();
        $this->userAgent = $request->header('User-Agent');
    }
}
