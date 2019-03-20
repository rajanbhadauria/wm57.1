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
use App\Model\Resume;
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
        return Validator::make($data, [
            'first_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6'],
            'g-recaptcha-response' => 'required',
        ]);
    }

    public function attributes()
    {
        return [
            'email' => 'email address',
        ];
    }

    private function generateRandomString($length = 5) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyz12388647374636411';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        $wmid = User::where('wmid', 'WM'.strtoupper($randomString))->get()->all();
        if(count($wmid)>0) {
            $this->generateRandomString();
        }

        return 'WM'.strtoupper($randomString);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    function updateresumeViewOnUpdate($email) {
        $resume = Resume::where('ownerEmail', $email);
        if($resume) {

        } else {
            $resume = new Resume();
            $resume->ownerEmail = $email;
            $resume->currentAddressData = "1"; $resume->permanentAddressData = "1";
            $resume->awardData = "1"; $resume->certificationData = "1";
            $resume->contactData = "1"; $resume->courseData = "1";
            $resume->educationData = "1"; $resume->languageData = "1";
            $resume->objectiveData = "1"; $resume->patentData = "1";
            $resume->profileData = "1"; $resume->projectData = "1";
            $resume->referenceData = "1"; $resume->skillData = "1";
            $resume->workData = "1";
            $resume->save();
        }

    }

    protected function create(array $data)
    {
        $activate_token = str_random(64);
        $wmid = $this->generateRandomString();
        $user =  User::create([
            'name' => $data['first_name'],
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'role'  => "3",
            'wmid' => $wmid,
            'status'   => "0",
            'activate_token' => $activate_token,
            'password' => bcrypt($data['password']),
        ]);
        User::contactListInit($data['email'], $user->id);
        $this->updateresumeViewOnUpdate($user->email);
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
