<?php

namespace App\Listeners;

use Illuminate\Support\Facades\Session;
use SimplerSaml\Events\SamlLogout;

class SamlUserLogout
{


    /**
     * Handle the event.
     *
     * @param  SamlLogout  $event
     * @return void
     */
    public function handle(SamlLogout $event)
    {
        // Remove laravel session after logout
        Session::flush();
    }
}
