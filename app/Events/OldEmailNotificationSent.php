<?php

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Models\Usuario;
use Illuminate\Http\Request;

class OldEmailNotificationSent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $usuario; // El usuario cuya cuenta se modificó
    public $oldEmail; // La dirección de email vieja
    public $newEmail; // La dirección de email nueva
    public $ipAddress;
    public $userAgent;

    public function __construct(Usuario $usuario, string $oldEmail, string $newEmail)
    {
        $this->usuario = $usuario;
        $this->oldEmail = $oldEmail;
        $this->newEmail = $newEmail;

        $request = app(Request::class);
        $this->ipAddress = $request->ip();
        $this->userAgent = $request->header('User-Agent');
    }
}
