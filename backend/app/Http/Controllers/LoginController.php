<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Log;

class LoginController extends Controller
{

    public function __construct()
    {
        $this->middleware('web');
    }


    /**
     * Create a Laravel Session for the user after login in
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function loginWithSaml(Request $request)
    {
        $samlUser =  $request->session()->get('user');
        if(!$samlUser) {
            abort(500, 'Sorry, an error occurred. Error: L02', ['UU-error' => 'L02']);
            Log::error('Error trying to log in a user: SAML user not found in session');
        }


        try {
            $user = User::where('solisid',$samlUser->offsetGet('solisid'))->first();
            if(!$user) {
//                $email = $samlUser->offsetGet('email');
//                $email = is_array($email) ? $email[0] : $email;
                $user = User::create([
                    'name' => $samlUser->offsetGet('solisid'),
                    'solisid' => $samlUser->offsetGet('solisid'),
//                    'email' => $email,
                ]);
                Log::debug(__CLASS__ . ': New user created');
            }
            Auth::guard('web')->login($user);

            $redirect = Config::get('simplersaml.loginRedirect');
            return redirect()->to($redirect);
        }
        catch (\Exception $exception) {
            Log::error('Error trying to log in a user: ' . $exception->getMessage());
            abort(500, 'Sorry, an error occurred. Error: L01', ['UU-error' => 'L01']);
        }
    }
}
