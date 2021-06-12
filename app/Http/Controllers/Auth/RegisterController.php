<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Mail\Registered;
use App\Rules\Captcha;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
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
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:master.user'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            // 'phone' => ['required', 'min:11', 'numeric', 'starts_with:+62, 62, 0']
            'phone' => ['required', 'regex:/(0|62|\+62)[0-9]{10}/'],
            'g-recaptcha-response' => new Captcha()
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        if(Str::startsWith($data['phone'], '0')) {
            $data['phone'] = Str::replaceFirst('0', '+62', $data['phone']);
        }
        elseif(Str::startsWith($data['phone'], '62')) {
            $data['phone'] = '+'.$data['phone'];
        }
        $user_referer = User::whereNotNull('referalid')->where('referalid', $data['referal'])->first();
        if($user_referer) {
            session()->put('user_referer', $user_referer);
        }
        
        $user = User::create([
            'fullname' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'nohp' => $data['phone'],
            'actorid' => 1,
            'registerdate' => Carbon::now(),
            'accessdate' => Carbon::now(),
            'ip' => request()->ip(),
            'refbp' => $user_referer ? $user_referer->id : null
        ]);
        Mail::to($user)->send(new Registered($user));
        return $user;
    }

    public function showRegistrationForm($referal = null)
    {
        return view('auth.register', compact('referal'));
    }
}
