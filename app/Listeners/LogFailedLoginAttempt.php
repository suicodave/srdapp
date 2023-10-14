<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

use Illuminate\Auth\Events\Failed;
use Illuminate\Support\Facades\Log;

class LogFailedLoginAttempt
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(Failed  $event)
    {
        $email = $event->credentials['email']; // Get the email from the login attempt
        $ipAddress = request()->ip(); // Get the user's IP address

        // Save the login attempt to a database table or log it
        // Example: Logging to Laravel's default log file
        Log::error("Failed login attempt for email: $email from IP address: $ipAddress");
    }
}
