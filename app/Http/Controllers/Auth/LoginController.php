<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Socialite;
use App\User;
use Auth;
use Mail;

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
    protected $redirectTo = '/activate-account';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function redirectToProvider($provider)
    {
      return Socialite::driver($provider)->redirect();
    }

    public function handleProviderCallback($provider)
    {
        try {
            $user = Socialite::driver($provider)->user();
        } catch (Exception $e) {
            return redirect('auth/'.$provider);
        }
        $user->social_type = $provider;
        $authUser = $this->createUser($user);
        Auth::login($authUser,true);
        return redirect()->route('home');

    }

    public function createUser($user){

        $authUser = User::where("email", $user->email)->first();
        if(is_object($authUser)){
            $authUser->social_type = $user->social_type;
            $authUser->avatar       = $user->avatar;
            $authUser->activate_token = $user->token;
            $authUser->google_id    = $user->id;
            $authUser->save();
            return $authUser;
        } else {
            $authUser = new User();
            $authUser->name         = $user->name;
            $authUser->google_id    = $user->id;
            $authUser->email        = $user->email;
            $authUser->role         = "3";
            $authUser->status       = "1";
            $authUser->avatar       = $user->avatar;
            $authUser->activate_token = $user->token;
            $authUser->social_type = $user->social_type;
            $authUser->save();
            return $authUser;
        }
    }


}
