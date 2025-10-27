<?php

namespace App\Providers;

use App\Listeners\SamlUserLogin;
use App\Listeners\SamlUserLogout;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use SimplerSaml\Events\SamlLogin;
use SimplerSaml\Events\SamlLogout;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        SamlLogin::class => [
            SamlUserLogin::class
        ],
        SamlLogout::class => [
            SamlUserLogout::class
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
    }
}
