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
        $public_path =  public_path();
        if(strpos(Auth::user()->avatar, 'ttp')) {
            $data['profileImage'] = Auth::user()->avatar;
        } elseif(Auth::user()->avatar != "") {
            $data['profileImage'] = uploads_url('images/user/'.Auth::user()->avatar);
        } else {
            $data['profileImage'] = uploads_url('images/user/user-img-white.jpg');
        }
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
}
