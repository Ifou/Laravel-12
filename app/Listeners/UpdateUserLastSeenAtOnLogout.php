<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Logout;
use Illuminate\Support\Facades\Log;

class UpdateUserLastSeenAtOnLogout
{
    /**
     * Handle the event.
     */
    public function handle(Logout $event): void
    {
        // Update the user's last_seen_at timestamp to null on logout
        // This allows for explicit differentiation between "inactive" and "logged out"
        $user = $event->user;
        
        if ($user) {
            $user->last_seen_at = null;
            $user->save();
            
            // Optional: Log the logout update
            Log::info('User logged out and last_seen_at cleared', [
                'user_id' => $user->id
            ]);
        }
    }
}
