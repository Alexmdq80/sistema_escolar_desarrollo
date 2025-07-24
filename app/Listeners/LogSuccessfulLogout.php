<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Logout;
use App\Models\AuthenticationAudit;
use Illuminate\Support\Facades\Log;
use App\Models\User;

class LogSuccessfulLogout
{
    /**
     * Handle the event.
     *
     * @param  Logout  $event
     * @return void
     */
    public function handle(Logout $event)
    {
        $auditable_type = null;
        $auditable_id = null;
        $emailAttempt = null;

        if ($event->user instanceof User) {
            // si es un usuario, entonces obtenemos sus datos
            $auditable_type = get_class($event->user);
            $auditable_id = $event->user->id;
            $emailAttempt =  $event->user->email;
        }
     // Prepare the data for auditing
        $auditData = [
            'auditable_type' => $auditable_type, // Will be null if user not found/invalid
            'auditable_id' => $auditable_id,     // Will be null if user not found/invalid
            'event' => 'logout',
            'url' => request()->fullUrl(),
            'ip_address' => request()->ip(),
            'user_agent' => request()->header('User-Agent'),
            'attempted_email' => $emailAttempt,
            'tags' => ['authentication', 'logout'],
            'audit_driver' => null,
            'details' => [ // Capture guard and exception message
                'guard' => $event->guard
            ],
        ];

        try {
            AuthenticationAudit::create($auditData);
            // Optionally log a debug message for successful audit.
            Log::debug('Successful logout audited for user.', ['user_id' => $auditable_id]);

        } catch (\Exception $e) {
            // Catch any exceptions that might occur during the audit creation.
            // This prevents the listener from breaking the login process.
            Log::error('Failed to log successful logout audit.', [
                'user_id' => $auditable_id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);
        }

    }
}
