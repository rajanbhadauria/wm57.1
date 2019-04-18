<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;
use Hash;
use URL;
use Mail;
use DB;
use App\Model\Resume;

use App\Helpers\Activity;
use App\Helpers\Email;

class UserController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }
    //
    public function profileImage(Request $request){
        $public_path =  public_path();
        if(strpos(Auth::user()->avatar, 'ttp')) {
            $data['profileImage'] = Auth::user()->avatar;
        } elseif(Auth::user()->avatar != "") {
            $data['profileImage'] = uploads_url('images/user/'.Auth::user()->avatar);
        } else {
            $data['profileImage'] = uploads_url('images/user/user-img-white.jpg');
        }
        $data['return_url'] = $request->query('ref_url');
        return view('user.profile-image',$data);
    }

    public function saveCropImage(Request $request){
        $data = $request->image;
        list($type, $data) = explode(';', $data);
        list(, $data)      = explode(',', $data);
        $public_path = public_path();

        $data = base64_decode($data);
        $image_name= Auth::user()->id.rand(1,10).time().'.png';
        if(!is_dir($path = public_path() . "/uploads/images/user")) {
            mkdir( $public_path. "/uploads/images/user", "0777");
        }

        $path = $public_path . "/uploads/images/user/" . $image_name;
        file_put_contents($path, $data);

        // Save file done


        // Now Save filename in database
        $user = User::find(Auth::id());
        $user->avatar = $image_name;
        $user->avatar_updated = date('Y-m-d H:i:s');
        $user->save();

        return response()->json(['success'=>'done']);

    }

    public function saveProfileImage(Request $request){
    	$input = $request->all();
    	$user = User::find(Auth::id());
    	$user->avatar = $input['image'];
    	$user->save();
	}

    public function imageRemove(){
        $user = User::find(Auth::id());
        $user->avatar = "";
        $user->save();
        return response()->json(['error'=>'0']);

    }

	public function changePassword(){
        return view('user.change-password');
    }

    public function changePasswordSave(Request $request){
        $input = $request->all();
        $passwordInDb = Auth::user()->password;
        if($input['newPassword']!=$input['confirmPassword']){

            return redirect()->back()
                     ->with("passwordNotMissmatch" , "Confirm passwoard not matched."); // will return only the errors */
        }

        if(Hash::check($input['oldPassword'],$passwordInDb)){
            $user = User::find(Auth::id());
            $user->password = Hash::make($input['newPassword']);
            $user->save();
            return redirect('/change-password')->with("success" , "Password has been updated successfully");
            //return redirect()->back()->with("success" , "Password Updated"); // will return only the errors */

        } else {
            return redirect()->back()
                     ->with("passwordMissmatch" , "Old Password missmatch"); // will return only the errors */
        }

    }

    public function activateAccountPage() {
        $user = User::find(Auth::id());
        if(isset($user->status) && $user->status == '1' ){
            return redirect('/home');
        }
        return view('user.activate-account');
    }

    public function activate($user_id,$token){
        $user = User::where("id","=",$user_id)->where("activate_token","=",$token)->get()->first();
        if(is_object($user) && $user->id == $user_id){
            Auth::login($user);
            $user->status = "1";
            $user->save();
            Auth::user()->status = 1;
            $data['title'] = "Account activated";
            $data['greeting'] = "Congratulation";
            $data['message'] = "Your account is now activate !";
        } else {
            $data['title'] = "Error";
            $data['greeting'] = "Oops! Somthing went wrong";
            $data['message'] = "User Id and token missmatch, Try again !";
        }
        //return view('user.activate-response', $data);
        return redirect('/home')->with('success', "Congrats ! Your account is activated");
    }

    public function resendActivation(){
        $user = User::find(Auth::id());
        $this->sendActivationEmail($user->id, $user->email, $user->first_name, $user->activate_token);
    }

    public function sendActivationEmail($user_id, $user_email, $user_first_name, $activate_token ){
        $url = URL::to('activate')."/".$user_id."/".$activate_token;
        $data['url'] = $url;
        Mail::send("auth.emails.activation", $data, function ($message) use ($user_email, $user_first_name) {
            $message->to($user_email,$user_first_name)->subject("WorkMedian : Activate account");
        });
    }

    public function deactivate(Request $request) {
        $input = $request->all();
        if(!$input) {
            return '{error: true, message: "Please select any option"}';
        } else {
            $user = User::find(Auth::id());
            if($user) {
                $user->account_status = $input['account_status'];
                $user->save();
                return response()->json(['success'=>true]);
            }
            else {
                return response()->json(['error'=>'false', 'message' => "There is some server error. Please try later!"]);
            }
        }
    }

    public function deactivateresp(Request $request) {
        $status = $request->query('status');
        $message = $status === 'closed' ? "Your account closed successfully" : "Your account is deactivated successfully";
        Auth::logout();
        return redirect('login')->with('success',$message);
    }

    // all users that all have in my contact list
    public function contactlist() {
        $data['users'] = User::getMyContacts(Auth::id());
        return view('user.contactlist', $data);
    }
    //listing all users that have my resume view access
    public function resumeAccessedUsers() {
        $data['users'] = Activity::getResumeAccessedUser(Auth::id(), Auth::user()->email);//Resume::getResumeAccessedUsersList(Auth::id());
        return view('user.resume_accessed_users', $data);
    }
    //listing all users that have my resume view access
    public function resumeViwedUsers() {
        $data['users'] = Resume::getResumeAccessedUsersList(Auth::id());
        return view('user.resume_viewed_users', $data);
    }
    // updating resume access
    public function resumeAccessedUpdate(Request $request) {
        $json['error'] = false;
        $json['error_msg'] = "";

        $inputs = $request->all();
        $email = base64_decode($inputs['user']);
        $update['is_visible'] = isset($inputs['is_visible']) ? '1' : '0';
        DB::table('resumes')->where('ownerEmail', Auth::user()->email)
                            ->where('userEmail', $email)
                            ->update(['is_visible' => $update['is_visible']]);
        return response()->json($json);
    }

    function accessRequests() {
        $user_id = Auth::id();
        $email = Auth::user()->email;
        $data['activities'] = Activity::getResumeAccessRequest($user_id, $email);
        return view('user.resume_access_request', $data);
    }

    function resumeReceivedRequests() {
        $user_id = Auth::id();
        $email = Auth::user()->email;
        $data['activities'] = Activity::getResumeReceivedRequest($user_id, $email);
        return view('user.resume_received_request', $data);
    }

    function invite() {
        return view('user.invite');
    }

    function inviteSave(Request $request) {
        $input = $request->all();
        $json['error'] = 0;
        $json['error_msg'] = "";
        $email = $input['email'];
        $message = $input['message'];
        if(!filter_var($email,FILTER_VALIDATE_EMAIL)) {
            $json['error'] = 1;
            $json['error_msg'] = "Please enter valid email id";
            return response()->json($json);
        }
        // checking if invited email already registered or not
        $user = User::where("email","=",$email)->get()->first();
        if($user) {
            $json['error'] = 1;
            $json['error_msg'] = "Email is already registered";
            return response()->json($json);
        }


        $inv_count = DB::table('user_invitations')
                            ->where('invited_by', "!=", Auth::id())
                            ->where('invited_email', $email)->count();
        $users = $inv_count > 1 ? 'users' : 'user';
        if($inv_count>0)
            $input['subject'] = Auth::user()->name." invited you to join WorkMedian with ".$inv_count. " other ".$users;
        else
            $input['subject'] = Auth::user()->name." invited you to join WorkMedian";
        $message = nl2br($message);
        Email::sendInvite($email,Auth::user()->name,$input['subject'],0, $message);
        $inv_user = DB::table('user_invitations')->where('invited_by', Auth::id())->where('invited_email', $email)->count();
        if($inv_user == 0) {
            $insertData['invited_by'] = Auth::id();
            $insertData['invited_email'] = $email;
            $invitation = DB::table('user_invitations')->insert($insertData);
        }
        $activity['byUser'] = Auth::id();
        $activity['email'] = $email;
        $activity['activity'] = "invitation_sent";
        $activity['created_at'] = date('Y-m-d H:i:s');
        $activity['request_status'] = 'accepted';
        // sent activity
        Activity::createActivity($activity);
        $request->session()->flash('success', 'Request has been sent successfully!');
        return response()->json($json);
    }

    // searching email for auto complete
    function searchEmail() {
        $term = Request()->input('term');
        $emails = [];
        if($term!="") {
            $result = User::select('email', 'name')
                        ->where(function($query) use ($term){
                            $query->orWhere('email', 'like', '%'.$term.'%')
                            ->orWhere('first_name', 'like', '%'.$term.'%')
                            ->orWhere('last_name', 'like', '%'.$term.'%');
                        })->where('email', '!=' , Auth::user()->email)
                            ->groupBy('email')
                            ->get();
            if($result) {
                foreach($result as $res) {
                    $emails[]  =array("value" => $res->email, "id" => $res->email, "label" => "(".$res->name.") ".$res->email);
                    }
            }

            $result = DB::table('notifications')->select('email')
                            ->where('email', 'like', '%'.$term.'%')
                            ->where('email', '!=' , Auth::user()->email)
                            ->groupBy('email')
                            ->get();
            if($result) {
                foreach($result as $res) {
                    if(!array_search($res->email, array_column($emails, 'id'))) {
                        $emails[] = array("value" => $res->email, "id" => $res->email, "label" => $res->email);
                    }
                   }
            }
        }
        return response()->json($emails);
    }

    function getResumeUrl(Request $req) {
        $inputs = $req->all();
        $json['success'] = false;
        $json['errorMsg'] = "";
        if($inputs) {

            $user = DB::table('users')->where('email', $req->owner_email)->first();
            if($user) {
                $json['success'] = true;
                $access = Resume::getResumeAccess($req->owner_email, $req->user_email);
                if($access) {
                    $json['url'] = url('wm/'.str_replace(" ", "-", $user->first_name)."-".str_replace(" ", "-", $user->last_name)."-".$access->id);
                }
                else {
                    $json['url'] = url('requestresume?request_id='.base64_encode($user->email));
                }
            } else {
                $json['errorMsg'] = "Invaild data supplied";
            }
        } else {
            $json['errorMsg'] = "Invaild data supplied";
        }
        return response()->json($json);

    }
}
