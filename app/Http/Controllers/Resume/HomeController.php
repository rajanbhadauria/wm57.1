<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Model\Resume;
use App\Model\UserBasicInformations;
use App\Helpers\Activity;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data['activityCount'] = Activity::countUserActivity(Auth::id(), Auth::user()->email);
        $data['resumeReceived'] = count(Activity::getResumeReceivedRequest(Auth::id(), Auth::user()->email));
        $data['members'] = User::getMyContacts(Auth::id());
        $data['viewCount'] = Resume::getResumeCount(Auth::id());
        return view('home', $data);
    }

    public function logout() {
        Auth::logout();
        return redirect('login')->with('success', "You are logged out");
    }

    public function settings()
    {
        return view('settings.index');
    }

    public function deactivate()
    {
        return view('settings.deactivate');
    }

    public function memberlist(Request $request) {
        $query = $request->all();
        $sortBY = !empty($query['sort']) ? $query['sort'] : "name";
        $key = !empty($query['q']) ? $query['q'] : "";
        $user = new User();
        $data['users'] =  $user->getMembersList(Auth::id(), $key, $sortBY);
        return view('home.memberlist', $data);
    }

    //user basic information
    public function postsignup(Request $request)
    {

        $basic_info = UserBasicInformations::where('user_id', Auth::id())->first();
         if(!is_object($basic_info)) {
             $basic_info =  new \stdClass();
             $basic_info->first_name = Auth::user()->first_name;
             $basic_info->last_name = Auth::user()->last_name;
        } else {
           $dob = explode("/", $basic_info->dob);
           $basic_info->ddStart = $dob[1];
           $basic_info->mmStart = $dob[0];
           $basic_info->yyyyStart = $dob[2];
        }
        $data['basic_info'] = $basic_info;
        $data['return_url'] = ($request->query('url')) ? url("/".$request->query('url')) : url("/settings");
        return view('user.postsignup', $data);
    }

    public function postsignupSave(Request $request){
        $input = $request->all();
        $basicInfo = UserBasicInformations::where('user_id', Auth::id())->first();
        if(!isset($basicInfo->id)){
            $basicInfo = new UserBasicInformations();
        }
        $basicInfo->user_id = Auth::id();
        $basicInfo->first_name = $input['first_name'];
        $basicInfo->middle_name = $input['middle_name'];
        $basicInfo->last_name = $input['last_name'];
        $basicInfo->skype_id = $input['skype_id'];
        $basicInfo->marital_status = $input['marital_status'];
        $basicInfo->dob = $input['mmStart']."/".$input['ddStart']."/".$input['yyyyStart'];
        $basicInfo->gender = isset($input['gender']) ? $input['gender'] : null;
        $basicInfo->save();
        // updating user table too
        $user = User::find(Auth::id());
        $user->name = $input['first_name'];
        $user->first_name = $input['first_name'];
        $user->last_name = $input['last_name'];
        $user->save();


        //return redirect()->back()->with('success', 'Basic information updated successfully.');
    }
}
