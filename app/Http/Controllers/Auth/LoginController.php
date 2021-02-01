<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use App\User;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::WELCOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Redirect the user to the GitHub authentication page.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback($provider)
    {
        $google_user = Socialite::driver($provider)->user();
        
        // OAuth Two Providers
        // $token = $google_user->token;
        // $refreshToken = $google_user->refreshToken; // not always provided
        // $expiresIn = $google_user->expiresIn;

        // OAuth One Providers
        // $token = $google_user->token;
        // $tokenSecret = $google_user->tokenSecret;

        // All Providers
        // $google_user->getId();
        // $google_user->getNickname();
        // $google_user->getName();
        // $google_user->getEmail();
        // $google_user->getAvatar();

        $user = User::where('email', $google_user->getEmail())->first();
        if($user) {
            if($user->gmailid == null) {
                $user->gmailid = $google_user->getId();
            }
            $user->token = $google_user->token;
            $user->save();
        }
        else {
            $user = new User();
            $user->fullname = $google_user->getName();
            $user->email = $google_user->getEmail();
            // $user->password = $tokenSecret;
            $user->token = $google_user->token;
            $user->gmailid = $google_user->getId();
            $user->avatarfile = $google_user->getAvatar();
            // $user->nohp = '';
            $user->save();
        }
        Auth::login($user);
        return redirect()->intended('welcome');
    }
}
