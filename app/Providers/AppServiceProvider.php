<?php

namespace App\Providers;

use Illuminate\Auth\RequestGuard;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;
use Lab404\Impersonate\Events\LeaveImpersonation;
use Lab404\Impersonate\Events\TakeImpersonation;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {

        Event::listen(function (TakeImpersonation $event) {
            session()->put([
                'password_hash_web' =>  $event->impersonated->getAuthPassword(),
                'password_hash_sanctum' => $event->impersonated->getAuthPassword(),
            ]);
        });

        Event::listen(function (LeaveImpersonation $event) {
            session()->put([
                'password_hash_sanctum' => $event->impersonator->getAuthPassword(),
                'password_hash_web' => $event->impersonator->getAuthPassword(),
            ]);
        });
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        RequestGuard::macro('quietLogin', function ($user) {
            $this->setUser($user);
        });
        RequestGuard::macro('quietLogout', function () {
            $this->forgetUser();
        });
        //
    }
}
