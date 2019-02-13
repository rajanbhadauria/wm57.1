<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;
use Hash;
use URL;
use Mail;

class UserController extends Controller
{
    //
    public function profileImage(){
        $data['profileImage'] = Auth::user()->avatar;
        return view('user.profile-image',$data);
    }

    public function saveCropImage(Request $request){

        $data = $request->image;
        list($type, $data) = explode(';', $data);
        list(, $data)      = explode(',', $data);


        $data = base64_decode($data);
        $image_name= time().'.png';
        $path = public_path() . "/uploads/images/user/" . $image_name;
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
            return redirect('/password/changepassword');
            //return redirect()->back()->with("success" , "Password Updated"); // will return only the errors */

        } else {
            return redirect()->back()
                     ->with("passwordMissmatch" , "Old Password missmatch"); // will return only the errors */
        }

    }

    public function activateAccountPage() {
        $user = User::find(Auth::id());
        if(isset($user->status) && $user->status=='1' ){
            return redirect('/home');
        }
        return view('user.activate-account');
    }

    public function activate($user_id,$token){
        $user = User::where("id","=",$user_id)->where("activate_token","=",$token)->get()->first();
        if(is_object($user) && $user->id == $user_id){
            $user->status =1;
            $user->save();
            $data['title'] = "Account activated";
            $data['greeting'] = "Congratulation";
            $data['message'] = "Your account is now activate !";
        } else {
            $data['title'] = "Error";
            $data['greeting'] = "Oops! Somthing went wrong";
            $data['message'] = "User Id and token missmatch, Try again !";
        }
        return view('user.activate-response', $data);
    }

    public function resendActivation(){

        //echo "I am here";
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
}
