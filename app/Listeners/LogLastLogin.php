<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Cache;

class LogLastLogin
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
    public function handle(object $event): void
    {
        $user = $event->user;
        $user->last_login_at = now();
        $user->save();

        // Tandai user sedang online
        Cache::put('user-is-online-' . $user->id, true, now()->addMinutes(5));
    }
}
