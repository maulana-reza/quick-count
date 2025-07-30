<?php

namespace App\Providers;

use App\Listeners\LogLastLogin;
use Illuminate\Auth\Events\Login;
use Illuminate\Support\ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }
    protected $listen = [
        Login::class => [
            LogLastLogin::class,
        ],
    ];

    public function boot(): void
    {
        //
    }
}
