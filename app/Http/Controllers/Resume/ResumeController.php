<?php

namespace App\Http\Controllers\Resume;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Requests;
use DB;
use Auth;
use App\User;
use Mail,URL;
use DateTime;

use App\Model\Contact;
use App\Model\Objective;
use App\Model\Address;
use App\Model\Education;
use App\Model\Project;
use App\Model\Skill;
use App\Model\Certification;
use App\Model\Training;
use App\Model\Course;
use App\Model\Travel;
use App\Model\Award;
use App\Model\Patent;
use App\Model\Language;
use App\Model\Reference;
use App\Model\Work;
use App\Helper\Email;
use App\Model\Resume;

use App\Model\Notification;
use App\Model\UserBasicInformations;
use App\Model\Resumetitle;
use App\Model\Softskills;
use App\Model\Interests;

class ResumeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request){
        $input = $request->all();
        return view('resume.index');
    }

    public function view(Request $request){
        $input = $request->all();

        $input = $request->all();
        if(isset($input['sectionid'])){
            $data['sectionid'] = $input['sectionid'];
        }


        $ownerEmail = Auth::user()->email;
        $data["resumeAccess"] = $resumeAccess = Resume::where("ownerEmail","=",$ownerEmail)->get()->first();
        $user_id = Auth::id();

        $data['profileData'] = User::where("id","=",$user_id)->get()->first();
        $data['contactInfo'] = Contact::where("user_id","=",$user_id)->get()->first();
        $data['contactCount'] = Contact::where("user_id","=",$user_id)->count();

        $data['objectiveInfo'] = Objective::where("user_id","=",$user_id)->get()->first();
        $data['objectiveCount'] = Objective::where("user_id","=",$user_id)->count();

        $data['currentAddressInfo'] = Address::where("user_id","=", Auth::id())->where("type","0")->get()->first();
        $data['currentAddressCount'] = Address::where("user_id","=", Auth::id())->where("type","0")->count();

        $data['permanentAddressInfo'] = Address::where("user_id","=", Auth::id())->where("type","1")->get()->first();
        $data['permanentAddressCount'] = Address::where("user_id","=", Auth::id())->where("type","1")->count();

        $data['workInfo']  = Work::where("user_id","=", Auth::id())->orderBy('workStartDate', 'desc')->get();
        $data['workCount'] = Work::where("user_id","=", Auth::id())->count();

        $data['currentWorkInfo']  = Work::where("user_id","=", Auth::id())->where("employementStatus","=","1")->get()->first();
        $data['currentWorkCount']  = Work::where("user_id","=", Auth::id())->where("employementStatus","=","1")->count();


        if($data['workCount'] > 0 ){
            if($data['workInfo'][0]->workEndDate!='0000-00-00 00:00:00'){
                $data['workEnding'] = $data['workInfo'][0]->workEndDate;
            }else{
                $data['workEnding'] = date('Y-m-d H:i:s');
            }
            foreach ($data['workInfo'] as $key => $work) {
                if($work->workEndDate!='0000-00-00 00:00:00'){
                    $data['workInfo'][$key]['duration'] = $this->dateDiffrence($work->workStartDate,$work->workEndDate);
                }else{
                    $data['workInfo'][$key]['duration'] = $this->dateDiffrence($work->workStartDate,date('Y-m-d H:i:s'));
                }
                $data['workStarting'] = $work->workStartDate;
            }
            //echo $data['workStarting'].",".$data['workEnding']."<br />";
            $data['totalWorkDuration'] = $this->dateDiffrence($data['workStarting'],$data['workEnding']);
        }
        $data['education'] = array('1' => 'Post graduation', '2' => 'Graduation', '3' => 'Under graduation');

        $data['educationInfo'] = Education::where("user_id","=", Auth::id())->orderBy('educationDate', 'desc')->get();
        $data['educationCount'] = Education::where("user_id","=", Auth::id())->count();

        $data['projectInfo'] = Project::where("user_id","=", Auth::id())->get();
        $data['projectCount'] = Project::where("user_id","=", Auth::id())->count();

        $data['skillInfo'] = Skill::where("user_id","=", Auth::id())->get();
        $data['skillCount'] = Skill::where("user_id","=", Auth::id())->count();

        $data['softskillInfo'] = Softskills::where("user_id","=", Auth::id())->first();
        $data['softskillCount'] = Softskills::where("user_id","=", Auth::id())->count();

        $data['certificationInfo'] = Certification::where("user_id","=", Auth::id())->get();
        $data['certificationCount'] = Certification::where("user_id","=", Auth::id())->count();

        $data['trainingInfo'] = Training::where("user_id","=", Auth::id())->get();
        $data['trainingCount'] = Training::where("user_id","=", Auth::id())->count();

        $data['courseInfo'] = Course::where("user_id","=", Auth::id())->get();
        $data['courseCount'] = Course::where("user_id","=", Auth::id())->count();



        $data['awardInfo']  = Award::where("user_id","=", Auth::id())->get();
        $data['awardCount'] = Award::where("user_id","=", Auth::id())->count();

        $data['patentInfo']  = Patent::where("user_id","=", Auth::id())->get();
        $data['patentCount'] = Patent::where("user_id","=", Auth::id())->count();

        $data['languageInfo']  = Language::where("user_id","=", Auth::id())->get();
        $data['languageCount'] = Language::where("user_id","=", Auth::id())->count();

        $data['referenceInfo']  = Reference::where("user_id","=", Auth::id())->get();
        $data['referenceCount'] = Reference::where("user_id","=", Auth::id())->count();

        $data['basicInfo']  = UserBasicInformations::where("user_id","=", Auth::id())->orderBy('updated_at', 'desc')->first();
        $data['basicInfoCount'] = UserBasicInformations::where("user_id","=", Auth::id())->count();

        $data['coverNote']  = Resumetitle::where("user_id","=", Auth::id())->orderBy('updated_at', 'desc')->first();
        $data['coverNoteCount'] = Resumetitle::where("user_id","=", Auth::id())->count();

        $data['miscellaneousInfo']  = DB::table('travels as TR')
                                        ->join('work_categories as WC', 'WC.id', '=', 'TR.work_category')
                                        ->where("TR.user_id", "=", Auth::id())

                                        ->orderBy('TR.projectStartDate', 'desc')
                                        ->get(['*', 'TR.id as id']);
        $data['miscellaneousCount'] = Travel::where("user_id","=", Auth::id())->count();

        $data['interestInfo'] = Interests::where("user_id","=", Auth::id())->first();
        $data['interestCount'] = Interests::where("user_id","=", Auth::id())->count();

        return view('resume.resumeview',$data);

    }

	public function view_old(Request $request){
        $input = $request->all();

        $input = $request->all();
        if(isset($input['sectionid'])){
            $data['sectionid'] = $input['sectionid'];
        }


        $ownerEmail = Auth::user()->email;
        $data["resumeAccess"] = $resumeAccess = Resume::where("ownerEmail","=",$ownerEmail)->get()->first();
        $user_id = Auth::id();

        $data['profileData'] = User::where("id","=",$user_id)->get()->first();
        $data['contactInfo'] = Contact::where("user_id","=",$user_id)->get()->first();
        $data['contactCount'] = Contact::where("user_id","=",$user_id)->count();

        $data['objectiveInfo'] = Objective::where("user_id","=",$user_id)->get()->first();
        $data['objectiveCount'] = Objective::where("user_id","=",$user_id)->count();

        $data['currentAddressInfo'] = Address::where("user_id","=", Auth::id())->where("type","0")->get()->first();
        $data['currentAddressCount'] = Address::where("user_id","=", Auth::id())->where("type","0")->count();

        $data['permanentAddressInfo'] = Address::where("user_id","=", Auth::id())->where("type","1")->get()->first();
        $data['permanentAddressCount'] = Address::where("user_id","=", Auth::id())->where("type","1")->count();

        $data['workInfo']  = Work::where("user_id","=", Auth::id())->orderBy('workStartDate', 'desc')->get();
        $data['workCount'] = Work::where("user_id","=", Auth::id())->count();

        $data['currentWorkInfo']  = Work::where("user_id","=", Auth::id())->where("employementStatus","=","1")->get()->first();
        $data['currentWorkCount']  = Work::where("user_id","=", Auth::id())->where("employementStatus","=","1")->count();


        if($data['workCount'] > 0 ){

            if($data['workInfo'][0]->workEndDate!='0000-00-00 00:00:00'){
                $data['workEnding'] = $data['workInfo'][0]->workEndDate;
            }else{
                $data['workEnding'] = date('Y-m-d H:i:s');
            }
            foreach ($data['workInfo'] as $key => $work) {
                if($work->workEndDate!='0000-00-00 00:00:00'){
                    $data['workInfo'][$key]['duration'] = $this->dateDiffrence($work->workStartDate,$work->workEndDate);
                }else{
                    $data['workInfo'][$key]['duration'] = $this->dateDiffrence($work->workStartDate,date('Y-m-d H:i:s'));
                }
                $data['workStarting'] = $work->workStartDate;
            }
            //echo $data['workStarting'].",".$data['workEnding']."<br />";
            $data['totalWorkDuration'] = $this->dateDiffrence($data['workStarting'],$data['workEnding']);
        }

        $data['educationInfo'] = Education::where("user_id","=", Auth::id())->orderBy('educationDate', 'desc')->get();
        $data['educationCount'] = Education::where("user_id","=", Auth::id())->count();

        $data['projectInfo'] = Project::where("user_id","=", Auth::id())->get();
        $data['projectCount'] = Project::where("user_id","=", Auth::id())->count();

        $data['skillInfo'] = Skill::where("user_id","=", Auth::id())->get();
        $data['skillCount'] = Skill::where("user_id","=", Auth::id())->count();

        $data['certificationInfo'] = Certification::where("user_id","=", Auth::id())->get();
        $data['certificationCount'] = Certification::where("user_id","=", Auth::id())->count();

        $data['trainingInfo'] = Training::where("user_id","=", Auth::id())->get();
        $data['trainingCount'] = Training::where("user_id","=", Auth::id())->count();

        $data['courseInfo'] = Course::where("user_id","=", Auth::id())->get();
        $data['courseCount'] = Course::where("user_id","=", Auth::id())->count();

        $data['travelInfo']  = Travel::where("user_id","=", Auth::id())->get();
        $data['travelCount'] = Travel::where("user_id","=", Auth::id())->count();

        $data['awardInfo']  = Award::where("user_id","=", Auth::id())->get();
        $data['awardCount'] = Award::where("user_id","=", Auth::id())->count();

        $data['patentInfo']  = Patent::where("user_id","=", Auth::id())->get();
        $data['patentCount'] = Patent::where("user_id","=", Auth::id())->count();

        $data['languageInfo']  = Language::where("user_id","=", Auth::id())->get();
        $data['languageCount'] = Language::where("user_id","=", Auth::id())->count();

        $data['referenceInfo']  = Reference::where("user_id","=", Auth::id())->get();
        $data['referenceCount'] = Reference::where("user_id","=", Auth::id())->count();



        return view('resume.view',$data);

    }

    public function dateDiffrence($date1,$date2){


        $date1 = new DateTime($date1);
        $date2 = new DateTime($date2);
        $interval = $date2->diff($date1);
        return $interval->format('%Y years, %m months');

    }

    public function saveShareData(Request $request){
        $input = $request->all();

        session(['shareData' => $input]);
        $ownerEmail = Auth::user()->email;
        if(Resume::where("ownerEmail","=",$ownerEmail)->count()>0) {
            Resume::where("ownerEmail","=",$ownerEmail)->update($input['shareData']);
        } else {
            $resume = new Resume();
            $input['shareData']["ownerEmail"] = $ownerEmail;
            $resume->insert($input['shareData']);
        }
    }

    public function getShareData(){
        $shareData = session('shareData');
        foreach($shareData['shareData'] as $key => $value) {
            echo $key." : ".$value."<br>";
        }
        //echo "shareData"."<br>";
        //print_r($shareData);
    }

    public function send(){
        $user_id = Auth::id();
        $data['profileData'] = User::where("id","=",$user_id)->get()->first();
        $data['currentWorkInfo']  = Work::where("user_id","=", $user_id)->where("employementStatus","=","1")->get()->first();
        $data['currentWorkCount']  = Work::where("user_id","=", $user_id)->where("employementStatus","=","1")->count();

        return view('resume.send',$data);
    }

    public function sendSave(Request $request){
        $input = $request->all();

        $updateFlag = 0;

        $ownerEmail = Auth::user()->email;
        $userEmail = $input['email'];
        $checkExistingResume = Resume::where("ownerEmail","=",$ownerEmail)->where("userEmail","=",$userEmail)->get()->count();

        if($checkExistingResume <= 0){
            $updateFlag = 0;
            $resume = new Resume();
            $resume->ownerEmail = $ownerEmail;
            $resume->userEmail = $userEmail;
            $resume->subject = $input['subject'];
            $resume->save();
            $shareData = session('shareData');
            Resume::where("id","=", $resume->id)->update($shareData['shareData']);
        } else {
            $updateFlag = 1;
            $resume = Resume::where("ownerEmail","=",$ownerEmail)->where("userEmail","=",$userEmail)->get()->first();
            $resume->subject = $input['subject'];
            $resume->save();
            $shareData = session('shareData');
            Resume::where("id","=", $resume->id)->update($shareData['shareData']);
        }


        $ownerData = User::where("email","=",$ownerEmail)->get()->first();

        $userAlreadyRegistered = User::where("email","=",$userEmail)->get()->count();
        $data['updateFlag'] = $updateFlag;
        $data['resumeId'] = $resume->id;
        if($userAlreadyRegistered > 0){
            $data['error'] = "0";
            Email::shareResume($userEmail,$ownerData->name,$input['subject'],$updateFlag);

        } else {
            $data['error'] = "1";
            Email::sendInvite($userEmail,$ownerData->name,$input['subject'],$updateFlag);
        }

        return response()->json($data);
    }

    public function resume($id){
        $data["resumeAccess"] = $resumeAccess = Resume::find($id);
        $ownerData = User::where("email","=",$resumeAccess['ownerEmail'])->get()->first();

        $user_id = $ownerData->id;

        $data['profileData'] = User::where("id","=",$user_id)->get()->first();
        $data['contactInfo'] = Contact::where("user_id","=",$user_id)->get()->first();
        $data['contactCount'] = Contact::where("user_id","=",$user_id)->count();

        $data['objectiveInfo'] = Objective::where("user_id","=",$user_id)->get()->first();
        $data['objectiveCount'] = Objective::where("user_id","=",$user_id)->count();

        $data['currentAddressInfo'] = Address::where("user_id","=", $user_id)->where("type","0")->get()->first();
        $data['currentAddressCount'] = Address::where("user_id","=", $user_id)->where("type","0")->count();

        $data['permanentAddressInfo'] = Address::where("user_id","=", $user_id)->where("type","1")->get()->first();
        $data['permanentAddressCount'] = Address::where("user_id","=", $user_id)->where("type","1")->count();

        $data['workInfo']  = Work::where("user_id","=", $user_id)->orderBy('workStartDate', 'desc')->get();
        $data['workCount'] = Work::where("user_id","=", $user_id)->count();

        $data['currentWorkInfo']  = Work::where("user_id","=", $user_id)->where("employementStatus","=","1")->get()->first();
        $data['currentWorkCount']  = Work::where("user_id","=", $user_id)->where("employementStatus","=","1")->count();


        if($data['workCount'] > 0 ){
            if($data['workInfo'][0]->workEndDate!='0000-00-00 00:00:00'){
                $data['workEnding'] = $data['workInfo'][0]->workEndDate;
            }else{
                $data['workEnding'] = date('Y-m-d H:i:s');
            }
            foreach ($data['workInfo'] as $key => $work) {
                if($work->workEndDate!='0000-00-00 00:00:00'){
                    $data['workInfo'][$key]['duration'] = $this->dateDiffrence($work->workStartDate,$work->workEndDate);
                }else{
                    $data['workInfo'][$key]['duration'] = $this->dateDiffrence($work->workStartDate,date('Y-m-d H:i:s'));
                }
                $data['workStarting'] = $work->workStartDate;
            }
            //echo $data['workStarting'].",".$data['workEnding']."<br />";
            $data['totalWorkDuration'] = $this->dateDiffrence($data['workStarting'],$data['workEnding']);
        }

        $data['educationInfo'] = Education::where("user_id","=", $user_id)->orderBy('educationDate', 'desc')->get();
        $data['educationCount'] = Education::where("user_id","=", $user_id)->count();

        $data['projectInfo'] = Project::where("user_id","=", $user_id)->get();
        $data['projectCount'] = Project::where("user_id","=", $user_id)->count();

        $data['skillInfo'] = Skill::where("user_id","=", $user_id)->get();
        $data['skillCount'] = Skill::where("user_id","=", $user_id)->count();

        $data['certificationInfo'] = Certification::where("user_id","=", $user_id)->get();
        $data['certificationCount'] = Certification::where("user_id","=", $user_id)->count();

        $data['trainingInfo'] = Training::where("user_id","=", $user_id)->get();
        $data['trainingCount'] = Training::where("user_id","=", $user_id)->count();

        $data['courseInfo'] = Course::where("user_id","=", $user_id)->get();
        $data['courseCount'] = Course::where("user_id","=", $user_id)->count();

        $data['travelInfo']  = Travel::where("user_id","=", $user_id)->get();
        $data['travelCount'] = Travel::where("user_id","=", $user_id)->count();

        $data['awardInfo']  = Award::where("user_id","=", $user_id)->get();
        $data['awardCount'] = Award::where("user_id","=", $user_id)->count();

        $data['patentInfo']  = Patent::where("user_id","=", $user_id)->get();
        $data['patentCount'] = Patent::where("user_id","=", $user_id)->count();

        $data['languageInfo']  = Language::where("user_id","=", $user_id)->get();
        $data['languageCount'] = Language::where("user_id","=", $user_id)->count();

        $data['referenceInfo']  = Reference::where("user_id","=", $user_id)->get();
        $data['referenceCount'] = Reference::where("user_id","=", $user_id)->count();

        return view('resume.resume',$data);

    }


    public function profile($user_id){

        $data['profileData'] = User::where("id","=",$user_id)->get()->first();
        $data['contactInfo'] = Contact::where("user_id","=",$user_id)->get()->first();
        $data['contactCount'] = Contact::where("user_id","=",$user_id)->count();

        $data['objectiveInfo'] = Objective::where("user_id","=",$user_id)->get()->first();
        $data['objectiveCount'] = Objective::where("user_id","=",$user_id)->count();

        $data['currentAddressInfo'] = Address::where("user_id","=", $user_id)->where("type","0")->get()->first();
        $data['currentAddressCount'] = Address::where("user_id","=", $user_id)->where("type","0")->count();

        $data['permanentAddressInfo'] = Address::where("user_id","=", $user_id)->where("type","1")->get()->first();
        $data['permanentAddressCount'] = Address::where("user_id","=", $user_id)->where("type","1")->count();

        $data['workInfo']  = Work::where("user_id","=", $user_id)->orderBy('workStartDate', 'desc')->get();
        $data['workCount'] = Work::where("user_id","=", $user_id)->count();

        $data['currentWorkInfo']  = Work::where("user_id","=", $user_id)->where("employementStatus","=","1")->get()->first();
        $data['currentWorkCount']  = Work::where("user_id","=", $user_id)->where("employementStatus","=","1")->count();


        if($data['workCount'] > 0 ){
            if($data['workInfo'][0]->workEndDate!='0000-00-00 00:00:00'){
                $data['workEnding'] = $data['workInfo'][0]->workEndDate;
            }else{
                $data['workEnding'] = date('Y-m-d H:i:s');
            }
            foreach ($data['workInfo'] as $key => $work) {
                if($work->workEndDate!='0000-00-00 00:00:00'){
                    $data['workInfo'][$key]['duration'] = $this->dateDiffrence($work->workStartDate,$work->workEndDate);
                }else{
                    $data['workInfo'][$key]['duration'] = $this->dateDiffrence($work->workStartDate,date('Y-m-d H:i:s'));
                }
                $data['workStarting'] = $work->workStartDate;
            }
            //echo $data['workStarting'].",".$data['workEnding']."<br />";
            $data['totalWorkDuration'] = $this->dateDiffrence($data['workStarting'],$data['workEnding']);
        }

        $data['educationInfo'] = Education::where("user_id","=", $user_id)->orderBy('educationDate', 'desc')->get();
        $data['educationCount'] = Education::where("user_id","=", $user_id)->count();

        $data['projectInfo'] = Project::where("user_id","=", $user_id)->get();
        $data['projectCount'] = Project::where("user_id","=", $user_id)->count();

        $data['skillInfo'] = Skill::where("user_id","=", $user_id)->get();
        $data['skillCount'] = Skill::where("user_id","=", $user_id)->count();

        $data['certificationInfo'] = Certification::where("user_id","=", $user_id)->get();
        $data['certificationCount'] = Certification::where("user_id","=", $user_id)->count();

        $data['trainingInfo'] = Training::where("user_id","=", $user_id)->get();
        $data['trainingCount'] = Training::where("user_id","=", $user_id)->count();

        $data['courseInfo'] = Course::where("user_id","=", $user_id)->get();
        $data['courseCount'] = Course::where("user_id","=", $user_id)->count();

        $data['travelInfo']  = Travel::where("user_id","=", $user_id)->get();
        $data['travelCount'] = Travel::where("user_id","=", $user_id)->count();

        $data['awardInfo']  = Award::where("user_id","=", $user_id)->get();
        $data['awardCount'] = Award::where("user_id","=", $user_id)->count();

        $data['patentInfo']  = Patent::where("user_id","=", $user_id)->get();
        $data['patentCount'] = Patent::where("user_id","=", $user_id)->count();

        $data['languageInfo']  = Language::where("user_id","=", $user_id)->get();
        $data['languageCount'] = Language::where("user_id","=", $user_id)->count();

        $data['referenceInfo']  = Reference::where("user_id","=", $user_id)->get();
        $data['referenceCount'] = Reference::where("user_id","=", $user_id)->count();

        return view('resume.profile',$data);

    }

}
