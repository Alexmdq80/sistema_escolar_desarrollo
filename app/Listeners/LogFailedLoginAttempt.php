<?php

namespace App\Listeners;

use App\Models\AuthenticationAudit;

use Illuminate\Auth\Events\Failed;
use Illuminate\Support\Facades\Log;
use App\Models\User;

class LogFailedLoginAttempt
{
    /**
     * Handle the event.
     *
     * @param  Failed  $event
     * @return void
     */
    public function handle(Failed $event)
    {
        $user_id = null;
        $auditable_type = null;
        $auditable_id = null;
        
        if ($event->user instanceof User) {
            $user_id = $event->user->id;
            $auditable_type = get_class($event->user);
            $auditable_id = $event->user->id;
        } else {
            /*Log::warning('Failed login event: User object not an instance of App\Models\User or is null.', [
                'user_data_received' => $event->user,
                'type_received' => gettype($event->user),
                'credentials_attempted' => $event->credentials,
                'guard_received' => $event->guard ?? 'N/A'
            ]);*/
             // This warning will now correctly reflect that $event->user is null for most failed attempts
            // Or, if caching is still an issue, it will show the incorrect type received.
            $eventAsArray = (array) $event;
            Log::warning('Failed login event: User object not an instance of App\Models\User or is null.', [
                'user_data_received' => $event->user,
                'type_received' => gettype($event->user),
                'credentials_from_event' => $event->credentials, // Renamed for clarity
                'guard_from_event' => $event->guard ?? 'N/A', // Renamed for clarity
             //   'exception_from_event' => $event->exception ? $event->exception->getMessage() : 'None',
            ]);
        }
        // Logic to extract email from credentials
        $emailAttempt = null;
        if (is_array($event->user) && isset($event->user['email'])) {

            $emailAttempt = $event->user['email'];
       
        } else {
            // This error will trigger if $event->credentials is NOT an array or doesn't have 'email'.
            // If this triggers after clearing cache, it means the event is STILL dispatched incorrectly.
            Log::error('Failed login listener: Credentials not in expected array format or missing email.', [
                'credentials_data' => $event->credentials,
                'credentials_type' => gettype($event->credentials),
            ]);
        }
          // Prepare the data for auditing
        $auditData = [
            'auditable_type' => $auditable_type, // Will be null if user not found/invalid
            'auditable_id' => $auditable_id,     // Will be null if user not found/invalid
            'event' => 'failed_login',
            'user_id' => $user_id, // Will be null if user not found/invalid
            'url' => request()->fullUrl(),
            'ip_address' => request()->ip(),
            'user_agent' => request()->header('User-Agent'),
            'attempted_email' => $emailAttempt,
            'tags' => ['authentication', 'failed_attempt'],
            'audit_driver' => null,
            'details' => [ // Capture guard and exception message
                'guard' => $event->credentials,
                //'exception' => $event->exception ? $event->exception->getMessage() : null,
                'exception' => null,

            ],
        ];

        try {
            AuthenticationAudit::create($auditData);
            Log::info('Failed login attempt audited successfully.', [
                'attempted_email' => $emailAttempt,
                'ip_address' => $auditData['ip_address'],
            ]);
        } catch (\Exception $e) {
            Log::error('Failed to save failed login audit record.', [
                'audit_data' => $auditData,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);
        }
    }
}
