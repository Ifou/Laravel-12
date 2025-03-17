<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Login;
use Illuminate\Support\Facades\Log;

class UpdateUserLastSeenAtOnLogin
{
    /**
     * Handle the event.
     */
    public function handle(Login $event): void
    {
        // Update the user's last_seen_at timestamp
        $user = $event->user;
        $user->last_seen_at = now();
        $user->save();

        // Optional: Log the login update
        Log::info('User logged in and last_seen_at updated', [
            'user_id' => $user->id,
            'timestamp' => $user->last_seen_at
        ]);
    }
}
