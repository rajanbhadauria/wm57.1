<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

use Auth;
use URL;
use Mail;

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
    protected $redirectTo = '/activate-account';

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
    public function messages()
    {
        return [
            'email.unique' => 'Email has already been taken, use your email for account registration',
        ];
    }

    protected function validator(array $data)
    {
        echo "<pre>"; print_r($_POST); echo "</pre>";
        return Validator::make($data, [
            'first_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6'],
            'g-recaptcha-response' => 'required|recaptcha',
        ]);
    }

    public function attributes()
    {
        return [
            'email' => 'email address',
        ];
    }



    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $activate_token = str_random(64);
        $user =  User::create([
            'name' => $data['first_name'],
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'role'  => "3",
            'status'   => "0",
            'activate_token' => $activate_token,
            'password' => bcrypt($data['password']),
        ]);

        $this->sendActivationEmail($user->id, $user->email, $user->first_name, $activate_token);

        return $user;
    }
    // sending activation mail
    public function sendActivationEmail($user_id, $user_email, $user_first_name, $activate_token ){
        $url = URL::to('activate')."/".$user_id."/".$activate_token;
        $data['url'] = $url;
        Mail::send("auth.emails.activation", $data, function ($message) use ($user_email, $user_first_name) {
            $message->to($user_email,$user_first_name)->subject("WorkMedian : Activate account");
        });
    }
}
