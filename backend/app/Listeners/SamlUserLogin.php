<?php

namespace App\Listeners;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use SimplerSaml\Events\SamlLogin;

class SamlUserLogin
{
    private $request;
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Handle the event.
     *
     * @param  SamlLogin  $event
     * @return void
     */
    public function handle(SamlLogin $event)
    {
        //
    }
}
