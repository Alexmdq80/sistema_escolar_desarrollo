<?php

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Models\User;
use Illuminate\Http\Request;

class ProfileUpdatedPasswordNotificationSent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $user;
    public $notifiedEmail; // El email al que se envió la notificación (el email actual del usuario)
    public $ipAddress;
    public $userAgent;

    /**
     * Create a new event instance.
     *
     * @param  \App\Models\User  $user  El usuario cuya información fue actualizada
     * @param  string  $notifiedEmail  El email al que se envió la notificación
     * @param  array  $oldData  Datos antiguos (nombre, apellido)
     * @param  array  $newData  Datos nuevos (nombre, apellido)
     * @return void
     */
    public function __construct(User $user, string $notifiedEmail)
    {
        $this->user = $user;
        $this->notifiedEmail = $notifiedEmail;

        $request = app(Request::class);
        $this->ipAddress = $request->ip();
        $this->userAgent = $request->header('User-Agent');
    }
}
