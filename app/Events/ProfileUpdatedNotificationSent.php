<?php

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Models\Usuario;
use Illuminate\Http\Request;

class ProfileUpdatedNotificationSent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $usuario;
    public $notifiedEmail; // El email al que se envió la notificación (el email actual del usuario)
    public $ipAddress;
    public $userAgent;
    public $oldData;
    public $newData;

    /**
     * Create a new event instance.
     *
     * @param  \App\Models\Usuario  $usuario  El usuario cuya información fue actualizada
     * @param  string  $notifiedEmail  El email al que se envió la notificación
     * @param  array  $oldData  Datos antiguos (nombre, apellido)
     * @param  array  $newData  Datos nuevos (nombre, apellido)
     * @return void
     */
    public function __construct(Usuario $usuario, string $notifiedEmail, array $oldData, array $newData)
    {
        $this->usuario = $usuario;
        $this->notifiedEmail = $notifiedEmail;
        $this->oldData = $oldData;
        $this->newData = $newData;

        $request = app(Request::class);
        $this->ipAddress = $request->ip();
        $this->userAgent = $request->header('User-Agent');
    }
}
