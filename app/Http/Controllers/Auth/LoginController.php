<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
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
        if(Auth::check()) {
            return redirect('/home');
        }

        $this->middleware('guest')->except('logout');
    }

    public function redirectToProvider($provider)
    {
      return Socialite::driver($provider)->redirect();
    }

    public function handleProviderCallback($provider,Request $request)
    {
        if (! $request->query('error')) {
            return redirect('login')->with('success '.$request->query('error_code').' - '.$request->query('error_description'));
        }

        try {
              $user = Socialite::driver($provider)->user();

        } catch (InvalidStateException $e) {
            return redirect('login');//
        } catch (Exception $e) {
            return redirect('auth/'.$provider);
        }
        $user->social_type = $provider;
        $authUser = $this->createUser($user);
        Auth::login($authUser,true);
        return redirect()->route('home');

    }

    private function generateRandomString($length = 5) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
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
            $wmid = $this->generateRandomString();
            $authUser = new User();
            $authUser->name         = $user->name;
            $authUser->google_id    = $user->id;
            $authUser->email        = $user->email;
            $authUser->role         = "3";
            $authUser->status       = "1";
            $authUser->avatar       = $user->avatar;
            $authUser->activate_token = $user->token;
            $authUser->wmid = $wmid;
            $authUser->social_type = $user->social_type;
            $authUser->save();
            return $authUser;
        }
    }

    protected function authenticated(Request $request, $user)
    {
        $upuser = User::find(Auth::id());
        if($user->account_status == 'closed') {
            Auth::logout();
            return redirect('/reactivate/'.$upuser->email);
        }
        if($user->account_status == 'deactive') {
           $upuser->account_status = 'active';
            $upuser->save();
            return redirect('/home')->with('success','Your account activated successfully');
        }
        if($user->status == '0') {
             return redirect('/activate-account');
         }
        return redirect('/home');
    }

    public function reactivate($email) {
        $data['email'] = $email;
        return view('user.reacitvate',$data);
    }

    public function closedActivate(Request $request) {
        $input = $request->all();
        if(!$input) {
            return '{error: true, message: "Invalid request."}';
        } else {
            $user = User::where('email', $input['email'])->update(['account_status'=>'active']);
            if($user) {
                session(['success' => 'Your account activated successfully.']);
                return response()->json(['success'=>true]);

            }
            else {
                return response()->json(['error'=>'false', 'message' => "There is some server error. Please try later!"]);
            }
        }
    }


}
