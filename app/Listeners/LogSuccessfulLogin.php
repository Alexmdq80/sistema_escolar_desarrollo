<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Login;
use App\Models\AuthenticationAudit;
use Illuminate\Support\Facades\Log; // Already there, good.
//use Illuminate\Http\Request; // Import Request for type-hinting if needed
use App\Models\User;

class LogSuccessfulLogin
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(Login $event): void
    {
        // Ensure the user object is valid before proceeding.
        // It's good practice to be explicit with the User model.
        if (! $event->user instanceof User) {
            Log::error('Login event fired without a valid App\\Models\\User object.', [
                'user_data' => $event->user,
                'event_class' => get_class($event),
            ]);
            return; // Stop execution if the user object is not as expected.
        }
        // Prepare the data for auditing
        $auditData = [
            'auditable_type' => get_class($event->user), // Will be null if user not found/invalid
            'auditable_id' => $event->user->id,     // Will be null if user not found/invalid
            'event' => 'login',
            'url' => request()->fullUrl(),
            'ip_address' => request()->ip(),
            'user_agent' => request()->header('User-Agent'),
            'attempted_email' => $event->user->email,
            'tags' => ['authentication', 'login', 'successful'],
            'audit_driver' => null,
            'details' => [ // Capture guard and exception message
                'guard' => $event->guard
                //'exception' => $exceptionMessage,
            ],
        ];

        try {
            AuthenticationAudit::create($auditData);
            // Optionally log a debug message for successful audit.
            Log::debug('Successful login audited for user.', ['user_id' => $event->user->id]);

        } catch (\Exception $e) {
            // Catch any exceptions that might occur during the audit creation.
            // This prevents the listener from breaking the login process.
            Log::error('Failed to log successful login audit.', [
                'user_id' => $event->user->id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);
        }
    }
}
