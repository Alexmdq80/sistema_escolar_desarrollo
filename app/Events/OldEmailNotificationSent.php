<?php

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Models\User;
use Illuminate\Http\Request;

class OldEmailNotificationSent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $user; // El usuario cuya cuenta se modificó
    public $oldEmail; // La dirección de email vieja
    public $newEmail; // La dirección de email nueva
    public $ipAddress;
    public $userAgent;

    public function __construct(User $user, string $oldEmail, string $newEmail)
    {
        $this->user = $user;
        $this->oldEmail = $oldEmail;
        $this->newEmail = $newEmail;

        $request = app(Request::class);
        $this->ipAddress = $request->ip();
        $this->userAgent = $request->header('User-Agent');
    }
}
