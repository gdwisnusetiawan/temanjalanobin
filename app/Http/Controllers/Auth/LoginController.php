<?php

namespace App\Http\Controllers\Auth;

use App\Mail\Registered;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Auth\Notifications\VerifyEmail;
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
        $socialite = Socialite::driver($provider)->user();
        
        // OAuth Two Providers
        // $token = $socialite->token;
        // $refreshToken = $socialite->refreshToken; // not always provided
        // $expiresIn = $socialite->expiresIn;

        // OAuth One Providers
        // $token = $socialite->token;
        // $tokenSecret = $socialite->tokenSecret;

        // All Providers
        // $socialite->getId();
        // $socialite->getNickname();
        // $socialite->getName();
        // $socialite->getEmail();
        // $socialite->getAvatar();

        $user = User::where('email', $socialite->getEmail())->first();
        if($user) {
            if($provider == 'google' && $user->gmailid == null) {
                $user->gmailid = $socialite->getId();
            }
            elseif($provider == 'facebook' && $user->facebookid == null) {
                $user->facebookid = $socialite->getId();
            }
            $user->token = $socialite->token;
            $user->save();
        }
        else {
            $user = new User();
            $user->fullname = $socialite->getName();
            $user->email = $socialite->getEmail();
            // $user->password = $tokenSecret;
            $user->token = $socialite->token;
            if($provider == 'google') {
                $user->gmailid = $socialite->getId();
            }
            elseif($provider == 'facebook') {
                $user->facebookid = $socialite->getId();
            }
            $user->avatarfile = $socialite->getAvatar();
            // $user->nohp = '';
            $user->save();
            Mail::to($user)->send(new Registered($user));
            $user->notify(new VerifyEmail);
        }
        Auth::login($user);
        return redirect()->intended('dashboard/welcome');
    }
}
