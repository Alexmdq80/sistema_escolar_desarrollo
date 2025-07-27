<?php

namespace App\Providers;

use App\Events\OldEmailNotificationSent;
use App\Events\EmailVerificationLinkSent;
use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\Logout;
use Illuminate\Auth\Events\Failed; // <-- ¡Importa este evento también!
use App\Listeners\LogSuccessfulLogin;
use App\Listeners\LogSuccessfulLogout;
use App\Listeners\LogFailedLoginAttempt; // <-- ¡Importa este Listener!
use App\Listeners\LogEmailVerificationSent;
use App\Listeners\LogOldEmailNotificationSent;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

//use Illuminate\Notifications\Events\NotificationSent;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    /*protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
    ];*/

    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        Login::class => [
            LogSuccessfulLogin::class,
        ],
        Logout::class => [
            LogSuccessfulLogout::class,
        ],
        Failed::class => [ // Evento para intentos de login fallidos
            LogFailedLoginAttempt::class,
        ],
        EmailVerificationLinkSent::class => [
            LogEmailVerificationSent::class,
        ],
        OldEmailNotificationSent::class => [
            LogOldEmailNotificationSent::class,
        ],
    ];


    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        //
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
