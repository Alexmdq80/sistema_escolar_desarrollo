<?php

namespace App\Providers;

use Illuminate\Auth\Events\PasswordReset;
use App\Events\PasswordResetRequested;
use App\Events\EmailVerifiedAction;
use App\Events\ProfileUpdatedPasswordNotificationSent;
use App\Events\ProfileUpdatedNotificationSent;
use App\Events\OldEmailNotificationSent;
use App\Events\EmailVerificationLinkSent;
use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\Logout;
use Illuminate\Auth\Events\Failed;
use App\Listeners\LogSuccessfulLogin;
use App\Listeners\LogSuccessfulLogout;
use App\Listeners\LogFailedLoginAttempt;
use App\Listeners\LogEmailVerificationSent;
use App\Listeners\LogOldEmailNotificationSent;
use App\Listeners\LogProfileUpdatedNotificationSent;
use App\Listeners\LogProfileUpdatedPasswordNotificationSent;
use App\Listeners\LogEmailVerifiedAction;
use App\Listeners\LogPasswordResetRequested;
use App\Listeners\LogPasswordResetSuccess;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

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
        ProfileUpdatedNotificationSent::class => [
            LogProfileUpdatedNotificationSent::class,
        ],
        ProfileUpdatedPasswordNotificationSent::class => [
            LogProfileUpdatedPasswordNotificationSent::class,
        ],
        EmailVerifiedAction::class => [
            LogEmailVerifiedAction::class,
        ],
        PasswordResetRequested::class => [
            LogPasswordResetRequested::class,
        ],
        PasswordReset::class => [
            LogPasswordResetSuccess::class,
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
