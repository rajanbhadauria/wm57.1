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
use PDF;

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
use App\Model\Resume;

use App\Model\Notification;
use App\Model\UserBasicInformations;
use App\Model\Resumetitle;
use App\Model\Softskills;
use App\Model\Interests;

use App\Helpers\Email;
use App\Helpers\Activity;

class ResumeController extends Controller
{

    public function __construct()
    {
        //$this->middleware('auth');
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

        $data['profileData'] = User::where("id","=",$user_id)->where("profilePrivate", '0')->get()->first();

        $data['contactInfo'] = Contact::where("user_id", $user_id)->where("private", '0')->get()->first();
        $data['contactCount'] = Contact::where("user_id","=",$user_id)->where("private", '0')->count();

        $data['objectiveInfo'] = Objective::where("user_id","=",$user_id)->where("private", '0')->get()->first();
        $data['objectiveCount'] = Objective::where("user_id","=",$user_id)->where("private", '0')->count();

        $data['currentAddressInfo'] = Address::where("user_id","=", Auth::id())->where("private", '0')->where("type","0")->get()->first();
        $data['currentAddressCount'] = Address::where("user_id","=", Auth::id())->where("private", '0')->where("type","0")->count();

        $data['permanentAddressInfo'] = Address::where("user_id","=", Auth::id())->where("private", '0')->where("type","1")->get()->first();
        $data['permanentAddressCount'] = Address::where("user_id","=", Auth::id())->where("private", '0')->where("type","1")->count();

        $data['workInfo']  = Work::where("user_id","=", Auth::id())->where("private", '0')->orderBy('workStartDate', 'desc')->orderBy('employementType', 'asc')->get();
        $data['workCount'] = Work::where("user_id","=", Auth::id())->where("private", '0')->count();

        $data['currentWorkInfo']  = Work::where("user_id","=", Auth::id())->where("private", '0')->where("employementStatus","=","1")->get()->first();
        $data['currentWorkCount']  = Work::where("user_id","=", Auth::id())->where("private", '0')->where("employementStatus","=","1")->count();


        if($data['workCount'] > 0 ){
            if($data['workInfo'][0]->workEndDate!='0000-00-00 00:00:00'){
                $data['workEnding'] = $data['workInfo'][0]->workEndDate;
            }else{
                $data['workEnding'] = date('Y-m-d H:i:s');
            }
            $ending = array();
            $current = 0;
            $start = array();
            foreach ($data['workInfo'] as $key => $work) {
                if($work->workEndDate!='0000-00-00 00:00:00'){
                    $data['workInfo'][$key]['duration'] = $this->dateDiffrence($work->workStartDate,$work->workEndDate);
                }else{
                    $data['workInfo'][$key]['duration'] = $this->dateDiffrence($work->workStartDate,date('Y-m-d H:i:s'));
                }
                $data['workStarting'] = $work->workStartDate;
                $start[$key] = $work->workStartDate;
                $ending[$key] = $work->workEndDate;
                if($work->employementStatus == "1") {
                    $current++;
                }

            }

            usort($start, 'dateSort');
            usort($ending, 'dateSort');
            $data['workStarting']  = $start[0];
            if($current) {
                $data['workEnding'] = date('Y-m-d H:i:s');
            } else {
                $data['workEnding'] =  $ending[count($ending)-1];
            }

            $data['totalWorkDuration'] = $this->dateDiffrence($data['workStarting'],$data['workEnding']);
        }
        $data['education'] = array('1' => 'Post graduation', '2' => 'Graduation', '3' => 'Under graduation');

        $data['educationInfo'] = Education::where("user_id","=", Auth::id())->where("private", '0')->orderBy('educationDate', 'desc')->get();
        $data['educationCount'] = Education::where("user_id","=", Auth::id())->where("private", '0')->count();

        $data['projectInfo'] = Project::where("user_id","=", Auth::id())->where("private", '0')->get();
        $data['projectCount'] = Project::where("user_id","=", Auth::id())->where("private", '0')->count();

        $data['skillInfo'] = Skill::where("user_id","=", Auth::id())->get()->where("private", '0')->first();
        $data['skillCount'] = Skill::where("user_id","=", Auth::id())->where("private", '0')->count();

        $data['softskillInfo'] = Softskills::where("user_id","=", Auth::id())->where("private", '0')->first();
        $data['softskillCount'] = Softskills::where("user_id","=", Auth::id())->where("private", '0')->count();

        $data['certificationInfo'] = Certification::where("user_id","=", Auth::id())->where("private", '0')->get();
        $data['certificationCount'] = Certification::where("user_id","=", Auth::id())->where("private", '0')->count();

        $data['trainingInfo'] = Training::where("user_id","=", Auth::id())->where("private", '0')->get();
        $data['trainingCount'] = Training::where("user_id","=", Auth::id())->where("private", '0')->count();

        $data['courseInfo'] = Course::where("user_id","=", Auth::id())->where("private", '0')->get();
        $data['courseCount'] = Course::where("user_id","=", Auth::id())->where("private", '0')->count();



        $data['awardInfo']  = Award::where("user_id","=", Auth::id())->where("private", '0')->get();
        $data['awardCount'] = Award::where("user_id","=", Auth::id())->where("private", '0')->count();

        $data['patentInfo']  = Patent::where("user_id","=", Auth::id())->where("private", '0')->get();
        $data['patentCount'] = Patent::where("user_id","=", Auth::id())->where("private", '0')->count();

        $data['languageInfo']  = Language::where("user_id","=", Auth::id())->where("private", '0')->get();
        $data['languageCount'] = Language::where("user_id","=", Auth::id())->where("private", '0')->count();

        $data['referenceInfo']  = Reference::where("user_id","=", Auth::id())->where("private", '0')->get();
        $data['referenceCount'] = Reference::where("user_id","=", Auth::id())->where("private", '0')->count();

        $data['basicInfo']  = UserBasicInformations::where("user_id","=", Auth::id())->orderBy('updated_at', 'desc')->first();
        $data['basicInfoCount'] = UserBasicInformations::where("user_id","=", Auth::id())->count();

        $data['coverNote']  = Resumetitle::where("user_id","=", Auth::id())->orderBy('updated_at', 'desc')->first();
        $data['coverNoteCount'] = Resumetitle::where("user_id","=", Auth::id())->count();

        $data['miscellaneousInfo']  = DB::table('travels as TR')
                                        ->join('work_categories as WC', 'WC.id', '=', 'TR.work_category')
                                        ->where("TR.user_id", "=", Auth::id())

                                        ->orderBy('TR.yyyyEnd', 'asc')
                                        ->get(['*', 'TR.id as id']);
        $data['miscellaneousCount'] = Travel::where("user_id","=", Auth::id())->count();

        $data['interestInfo'] = Interests::where("user_id","=", Auth::id())->first();
        $data['interestCount'] = Interests::where("user_id","=", Auth::id())->count();

        return view('resume.resumeview',$data);

    }


    public function dateDiffrence($date1,$date2){


        $date1 = new DateTime($date1);
        $date2 = new DateTime($date2);
        $interval = $date2->diff($date1);
        $date = "";
        if($interval->format('%y')>1)
            $date .= $interval->format('%y years');
        else
            $date .= $interval->format('%y year');

        if($interval->format('%m')>1)
            $date .= $interval->format(', %m months');
        else
            $date .= $interval->format(', %m month');

        return $date;

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
        foreach($input['shareData'] as $key => $data) {
            if($data == '1')
                    $data = '0';
                else
                    $data = '1';
            if('workData' == $key) {
                DB::table('work')->where('user_id',Auth::id())->update(array(
                    'private'=>$data,
                    ));
            }
            if('projectData' == $key) {
                DB::table('projects')->where('user_id',Auth::id())->update(array(
                    'private'=>$data,
                    ));
            }
            if('certificationData' == $key) {
                DB::table('certifications')->where('user_id',Auth::id())->update(array(
                    'private'=>$data,
                    ));
            }
            if('trainingData' == $key) {
                DB::table('trainings')->where('user_id',Auth::id())->update(array(
                    'private'=>$data,
                    ));
            }
            //
            if('travelData' == $key) {
                DB::table('travels')->where('user_id',Auth::id())->update(array(
                    'private'=>$data,
                    ));
            }
            if('courseData' == $key) {
                DB::table('courses')->where('user_id',Auth::id())->update(array(
                    'private'=>$data,
                    ));
            }
            if('educationData' == $key) {
                    DB::table('education')->where('user_id',Auth::id())->update(array(
                        'private'=>$data,
                        ));
            }
            if('awardData' == $key) {
                DB::table('awards')->where('user_id',Auth::id())->update(array(
                    'private'=>$data,
                    ));
            }
            //
            if('languageData' == $key) {
                DB::table('languages')->where('user_id',Auth::id())->update(array(
                    'private'=>$data,
                    ));
            }
            if('referenceData' == $key) {
                DB::table('references')->where('user_id',Auth::id())->update(array(
                    'private'=>$data,
                    ));
            }

            if('basicInfoData' == $key) {
                DB::table('user_basic_informations')->where('user_id',Auth::id())->update(array(
                    'private'=>$data,
                    ));
            }

            if('contactData' == $key) {
                DB::table('contacts')->where('user_id',Auth::id())->update(array(
                    'private'=>$data,
                    ));
            }

            if('currentAddressData' == $key) {
                DB::table('addresses')->where('user_id',Auth::id())->where('type', '0')->update(array(
                    'private'=>$data,
                    ));
            }

            if('permanentAddressData' == $key) {
                DB::table('addresses')->where('user_id',Auth::id())->where('type', '1')->update(array(
                    'private'=>$data,
                    ));
            }

            if('interestData' == $key) {
                DB::table('interests')->where('user_id',Auth::id())->update(['private'=>$data]);
            }

            if('softskillData' == $key) {
                DB::table('softskills')->where('user_id',Auth::id())->update(['private'=>$data]);
            }

            if('skillData' == $key) {
                DB::table('skills')->where('user_id',Auth::id())->update(['private'=>$data]);
            }

            if('resumetitleData' == $key) {
                DB::table('resume_titles')->where('user_id',Auth::id())->update(['private'=>$data]);
            }

            if('profileData' == $key) {
                DB::table('users')->where('id',Auth::id())->update(['profilePrivate'=>$data]);
            }

            if('objectiveData' == $key) {
                DB::table('objective')->where('user_id',Auth::id())->update(['private'=>$data]);
            }


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
        $data['countryNameList'] = ["Afghanistan","Albania","Algeria","American Samoa","Andorra","Angola","Anguilla","Antarctica","Antigua and Barbuda","Argentina","Armenia","Aruba","Australia","Austria","Azerbaijan","Bahamas","Bahrain","Bangladesh","Barbados","Belarus","Belgium","Belize","Benin","Bermuda","Bhutan","Bolivia","Bosnia and Herzegovina","Botswana","Brazil","British Indian Ocean Territory","British Virgin Islands","Brunei","Bulgaria","Burkina Faso","Burundi","Cambodia","Cameroon","Canada","Cape Verde","Cayman Islands","Central African Republic","Chad","Chile","China","Christmas Island","Cocos Islands","Colombia","Comoros","Cook Islands","Costa Rica","Croatia","Cuba","Curacao","Cyprus","Czech Republic","Democratic Republic of the Congo","Denmark","Djibouti","Dominica","Dominican Republic","East Timor","Ecuador","Egypt","El Salvador","Equatorial Guinea","Eritrea","Estonia","Ethiopia","Falkland Islands","Faroe Islands","Fiji","Finland","France","French Polynesia","Gabon","Gambia","Georgia","Germany","Ghana","Gibraltar","Greece","Greenland","Grenada","Guam","Guatemala","Guernsey","Guinea","Guinea-Bissau","Guyana","Haiti","Honduras","Hong Kong","Hungary","Iceland","India","Indonesia","Iran","Iraq","Ireland","Isle of Man","Israel","Italy","Ivory Coast","Jamaica","Japan","Jersey","Jordan","Kazakhstan","Kenya","Kiribati","Kosovo","Kuwait","Kyrgyzstan","Laos","Latvia","Lebanon","Lesotho","Liberia","Libya","Liechtenstein","Lithuania","Luxembourg","Macau","Macedonia","Madagascar","Malawi","Malaysia","Maldives","Mali","Malta","Marshall Islands","Mauritania","Mauritius","Mayotte","Mexico","Micronesia","Moldova","Monaco","Mongolia","Montenegro","Montserrat","Morocco","Mozambique","Myanmar","Namibia","Nauru","Nepal","Netherlands","Netherlands Antilles","New Caledonia","New Zealand","Nicaragua","Niger","Nigeria","Niue","North Korea","Northern Mariana Islands","Norway","Oman","Pakistan","Palau","Palestine","Panama","Papua New Guinea","Paraguay","Peru","Philippines","Pitcairn","Poland","Portugal","Puerto Rico","Qatar","Republic of the Congo","Reunion","Romania","Russia","Rwanda","Saint Barthelemy","Saint Helena","Saint Kitts and Nevis","Saint Lucia","Saint Martin","Saint Pierre and Miquelon","Saint Vincent and the Grenadines","Samoa","San Marino","Sao Tome and Principe","Saudi Arabia","Senegal","Serbia","Seychelles","Sierra Leone","Singapore","Sint Maarten","Slovakia","Slovenia","Solomon Islands","Somalia","South Africa","South Korea","South Sudan","Spain","Sri Lanka","Sudan","Suriname","Svalbard and Jan Mayen","Swaziland","Sweden","Switzerland","Syria","Taiwan","Tajikistan","Tanzania","Thailand","Togo","Tokelau","Tonga","Trinidad and Tobago","Tunisia","Turkey","Turkmenistan","Turks and Caicos Islands","Tuvalu","U.S. Virgin Islands","Uganda","Ukraine","United Arab Emirates","United Kingdom","United States","Uruguay","Uzbekistan","Vanuatu","Vatican","Venezuela","Vietnam","Wallis and Futuna","Western Sahara","Yemen","Zambia","Zimbabwe"];
    	$data['countryCodeList'] = ["93","355","213","1-684","376","244","1-264","672","1-268","54","374","297","61","43","994","1-242","973","880","1-246","375","32","501","229","1-441","975","591","387","267","55","246","1-284","673","359","226","257","855","237","1","238","1-345","236","235","56","86","61","61","57","269","682","506","385","53","599","357","420","243","45","253","1-767","1-809, 1-829, 1-849","670","593","20","503","240","291","372","251","500","298","679","358","33","689","241","220","995","49","233","350","30","299","1-473","1-671","502","44-1481","224","245","592","509","504","852","36","354","91","62","98","964","353","44-1624","972","39","225","1-876","81","44-1534","962","7","254","686","383","965","996","856","371","961","266","231","218","423","370","352","853","389","261","265","60","960","223","356","692","222","230","262","52","691","373","377","976","382","1-664","212","258","95","264","674","977","31","599","687","64","505","227","234","683","850","1-670","47","968","92","680","970","507","675","595","51","63","64","48","351","1-787, 1-939","974","242","262","40","7","250","590","290","1-869","1-758","590","508","1-784","685","378","239","966","221","381","248","232","65","1-721","421","386","677","252","27","82","211","34","94","249","597","47","268","46","41","963","886","992","255","66","228","690","676","1-868","216","90","993","1-649","688","1-340","256","380","971","44","1","598","998","678","379","58","84","681","212","967","260","263"];
        $data['profileData'] = User::where("id","=",$user_id)->get()->first();


        return view('resume.send',$data);
    }

    // changing passcode
    function changePasscode() {
        if(Auth::user()->resume_passcode) {
            return Auth::user()->resume_passcode;
        }
        $rand = mt_rand(100000, 999999);
        $user = User::find(Auth::id());
        $user->resume_passcode = $rand;
        $user->save();
        return $rand;
    }
    // inviting user to join
    public function inviteUser(Request $request){
        $input = $request->all();
        $json['error'] = 0;
        $json['error_msg'] = "";
        $user = DB::table('user_invitations')->where('invited_by', Auth::id())->where('invited_email', $input['email'])->count();
        if($user>0) {
            $json['error'] = 1;
            $json['error_msg'] = "User is already invited.";
        } else {
            $inv_count = DB::table('user_invitations')->where('invited_email', $input['email'])->count();
            $users = $inv_count > 1 ? 'users' : 'user';
            if($inv_count>0)
                $input['subject'] = Auth::user()->name." invited to join WorkMedian with ".$inv_count. " other ".$users;
            else
            $input['subject'] = Auth::user()->name." invited to join WorkMedian to access his resume";
            $message = nl2br($input['message']);
            $insertData['invited_by'] = Auth::id();
            $insertData['invited_email'] = $input['email'];
            $invitation = DB::table('user_invitations')->insert($insertData);
            Email::sendInvite($input['email'],Auth::user()->name,$input['subject'],0, $message);
        }
        return response()->json($json);

    }

    public function sendSave(Request $request){
        $input = $request->all();
        $json['invite_user'] = "0";
        // checking if user is send resume to him self
        if($input['email'] === Auth::user()->email) {
            $json['error'] = 1;
            $json['error_msg'] = "You can not send resume to your self";
            return response()->json($json);
        }

        // check if you already sent the resume
        $user = DB::table('notifications')->where('byUser', Auth::id())->where('email', $input['email'])->first();
        if($user) {
            $json['error'] = 1;
            $json['error_msg'] = "You already sent the resume to this user";
            return response()->json($json);
        }

        $input['subject'] = Auth::user()->first_name."'s resume received ";
        $updateFlag = 0;
        $ownerEmail = Auth::user()->email;
        $userEmail = $input['email'];
        $sharedArray = Resume::where("ownerEmail",$ownerEmail)->whereNull("userEmail")->first();

        if($sharedArray) {
            $sharedArray = $sharedArray->toArray();
            foreach($sharedArray as $key => $share)  {
                if($key!='id' && $key!= 'ownerEmail' && $key!= 'userEmail' && $key!= 'created_at' && $key != 'updated_at')
                    $shareData['shareData'][$key] = $share;
            }
        } else {
            $json['error'] = 1;
            $json['error_msg'] = "Please complete your resume first";
            return response()->json($json);
        }
        $activity['byUser'] = Auth::id();
        $shareData['shareData']['is_secure'] = $input['is_secure'];
        $shareData['shareData']['coverLetter'] = $input['message'];
        $checkExistingResume = Resume::where("ownerEmail","=",$ownerEmail)->where("userEmail","=",$userEmail)->get()->count();
        if($checkExistingResume <= 0){
            $updateFlag = 0;
            $resume = new Resume();
            $resume->ownerEmail = $ownerEmail;
            $resume->userEmail = $userEmail;
            $resume->subject = $input['subject'];
            $resume->save();
            $activity['resume_id'] = $resume->id;
            Resume::where("id","=", $resume->id)->update($shareData['shareData']);
        } else {
            $updateFlag = 1;
            $resume = Resume::where("ownerEmail","=",$ownerEmail)->where("userEmail","=",$userEmail)->get()->first();
            //$resume->subject = $input['subject'];
            $resume->save();
            //$shareData = session('shareData');
            Resume::where("id","=", $resume->id)->update($shareData['shareData']);
            $activity['resume_id'] = $resume->id;
        }


        $ownerData = User::where("email","=",$ownerEmail)->get()->first();
        $getUser = User::where("email","=",$userEmail)->get()->first();

        $data['updateFlag'] = $updateFlag;
        $data['resumeId'] = $resume->id;
        $name = str_replace(" ", "-", Auth::user()->first_name."-".Auth::user()->last_name);
        $message = $input['message'];

        $passCode = $input['is_secure'] == '0' ? "wm94510" : $this->changePasscode();
        $url = $name."-".$data['resumeId']."/".$passCode;
        $message .=  "<br/>Click <a heref='".URL::to('wm').'/'.$url."'>here</a> to view resume or <br> copy paste url " . URL::to('wm')."/".$url;
        if($getUser){
            $activity['forUser'] = $getUser->id;
            $json['error'] = "0";
            Email::shareResume($userEmail,$ownerData->name,$input['subject'],$updateFlag, $message);
        } else {
            $json['error'] = "0";
            //Email::sendInvite($userEmail,$ownerData->name,$input['subject'],$updateFlag, $message);
            $json['invite_user'] = "1";
        }
        Resume::where("id","=", $resume->id)->update(['resume_url'=>$url]);
        $activity['email'] = $userEmail;
        $activity['activity'] = "resume_sent";
        $activity['created_at'] = date('Y-m-d H:i:s');
        $activity['resume_id'] = $resume->id;
        $activity['request_status'] = 'accepted';
        // sent activity
        Activity::createActivity($activity);

        $request->session()->flash('success', 'Request has been sent successfully!');
        return response()->json($json);
    }

    public function resume($id){
        $url = explode("-", $id);
        $id = end($url);
        $data["resumeAccess"] = $resumeAccess = Resume::find($id);
        if(!$data["resumeAccess"] || $resumeAccess->userEmail != Auth::user()->email) {
            return redirect('/home')->with('error', 'You are not allowed to access this page!');
        }
        $ownerData = User::where("email","=",$resumeAccess['ownerEmail'])->get()->first();

        $user_id = $ownerData->id;

        $data['profileData'] = User::where("id","=",$user_id)->where("profilePrivate", '0')->get()->first();
        $data['contactInfo'] = Contact::where("user_id", $user_id)->where("private", '0')->get()->first();
        $data['contactCount'] = Contact::where("user_id","=",$user_id)->where("private", '0')->count();

        $data['objectiveInfo'] = Objective::where("user_id","=",$user_id)->where("private", '0')->get()->first();
        $data['objectiveCount'] = Objective::where("user_id","=",$user_id)->where("private", '0')->count();

        $data['currentAddressInfo'] = Address::where("user_id","=", $user_id)->where("private", '0')->where("type","0")->get()->first();
        $data['currentAddressCount'] = Address::where("user_id","=", $user_id)->where("private", '0')->where("type","0")->count();

        $data['permanentAddressInfo'] = Address::where("user_id","=", $user_id)->where("private", '0')->where("type","1")->get()->first();
        $data['permanentAddressCount'] = Address::where("user_id","=", $user_id)->where("private", '0')->where("type","1")->count();

        $data['workInfo']  = Work::where("user_id","=", $user_id)->where("private", '0')->orderBy('workStartDate', 'desc')->orderBy('employementType', 'asc')->get();
        $data['workCount'] = Work::where("user_id","=", $user_id)->where("private", '0')->count();

        $data['currentWorkInfo']  = Work::where("user_id","=", $user_id)->where("private", '0')->where("employementStatus","=","1")->get()->first();
        $data['currentWorkCount']  = Work::where("user_id","=", $user_id)->where("private", '0')->where("employementStatus","=","1")->count();


        if($data['workCount'] > 0 ){
            if($data['workInfo'][0]->workEndDate!='0000-00-00 00:00:00'){
                $data['workEnding'] = $data['workInfo'][0]->workEndDate;
            }else{
                $data['workEnding'] = date('Y-m-d H:i:s');
            }
            $ending = array();
            $current = 0;
            $start = array();
            foreach ($data['workInfo'] as $key => $work) {
                if($work->workEndDate!='0000-00-00 00:00:00'){
                    $data['workInfo'][$key]['duration'] = $this->dateDiffrence($work->workStartDate,$work->workEndDate);
                }else{
                    $data['workInfo'][$key]['duration'] = $this->dateDiffrence($work->workStartDate,date('Y-m-d H:i:s'));
                }
                $data['workStarting'] = $work->workStartDate;
                $start[$key] = $work->workStartDate;
                $ending[$key] = $work->workEndDate;
                if($work->employementStatus == "1") {
                    $current++;
                }

            }

            usort($start, 'dateSort');
            usort($ending, 'dateSort');
            $data['workStarting']  = $start[0];
            if($current) {
                $data['workEnding'] = date('Y-m-d H:i:s');
            } else {
                $data['workEnding'] =  $ending[count($ending)-1];
            }

            $data['totalWorkDuration'] = $this->dateDiffrence($data['workStarting'],$data['workEnding']);
        }
        $data['education'] = array('1' => 'Post graduation', '2' => 'Graduation', '3' => 'Under graduation');

        $data['educationInfo'] = Education::where("user_id","=", $user_id)->where("private", '0')->orderBy('educationDate', 'desc')->get();
        $data['educationCount'] = Education::where("user_id","=", $user_id)->where("private", '0')->count();

        $data['projectInfo'] = Project::where("user_id","=", $user_id)->where("private", '0')->get();
        $data['projectCount'] = Project::where("user_id","=", $user_id)->where("private", '0')->count();

        $data['skillInfo'] = Skill::where("user_id","=", $user_id)->get()->where("private", '0')->first();
        $data['skillCount'] = Skill::where("user_id","=", $user_id)->where("private", '0')->count();

        $data['softskillInfo'] = Softskills::where("user_id","=", $user_id)->where("private", '0')->first();
        $data['softskillCount'] = Softskills::where("user_id","=", $user_id)->where("private", '0')->count();

        $data['certificationInfo'] = Certification::where("user_id","=", $user_id)->where("private", '0')->get();
        $data['certificationCount'] = Certification::where("user_id","=", $user_id)->where("private", '0')->count();

        $data['trainingInfo'] = Training::where("user_id","=", $user_id)->where("private", '0')->get();
        $data['trainingCount'] = Training::where("user_id","=", $user_id)->where("private", '0')->count();

        $data['courseInfo'] = Course::where("user_id","=", $user_id)->where("private", '0')->get();
        $data['courseCount'] = Course::where("user_id","=", $user_id)->where("private", '0')->count();



        $data['awardInfo']  = Award::where("user_id","=", $user_id)->where("private", '0')->get();
        $data['awardCount'] = Award::where("user_id","=", $user_id)->where("private", '0')->count();

        $data['patentInfo']  = Patent::where("user_id","=", $user_id)->where("private", '0')->get();
        $data['patentCount'] = Patent::where("user_id","=", $user_id)->where("private", '0')->count();

        $data['languageInfo']  = Language::where("user_id","=", $user_id)->where("private", '0')->get();
        $data['languageCount'] = Language::where("user_id","=", $user_id)->where("private", '0')->count();

        $data['referenceInfo']  = Reference::where("user_id","=", $user_id)->where("private", '0')->get();
        $data['referenceCount'] = Reference::where("user_id","=", $user_id)->where("private", '0')->count();

        $data['basicInfo']  = UserBasicInformations::where("user_id","=", $user_id)->orderBy('updated_at', 'desc')->first();
        $data['basicInfoCount'] = UserBasicInformations::where("user_id","=", $user_id)->count();

        $data['coverNote']  = Resumetitle::where("user_id","=", $user_id)->orderBy('updated_at', 'desc')->first();
        $data['coverNoteCount'] = Resumetitle::where("user_id","=", $user_id)->count();

        $data['miscellaneousInfo']  = DB::table('travels as TR')
                                        ->join('work_categories as WC', 'WC.id', '=', 'TR.work_category')
                                        ->where("TR.user_id", "=", $user_id)

                                        ->orderBy('TR.yyyyEnd', 'asc')
                                        ->get(['*', 'TR.id as id']);
        $data['miscellaneousCount'] = Travel::where("user_id","=", $user_id)->count();

        $data['interestInfo'] = Interests::where("user_id","=", $user_id)->first();
        $data['interestCount'] = Interests::where("user_id","=", $user_id)->count();

        return view('resume.resume',$data);

    }

    // resume view with passcode
    public function resumeView($id, $passcode=0){
        $user_url = $id;
        $url = explode("-", $id);
        $id = end($url);
        $data["resumeAccess"] = $resumeAccess = Resume::where('id','=',$id)->get()->first();
        if(!$data["resumeAccess"] || $id == '0') {
            return view('access_denied');
        }
        $ownerData = User::where("email","=",$resumeAccess['ownerEmail'])->get()->first();
        if($ownerData->resume_passcode != $passcode) {
            return view('resume.enterpasscode', array('user' => $ownerData,  'id'=> $user_url));
        }
        $ownerData = User::where("email","=",$resumeAccess['ownerEmail'])->get()->first();
        $notification = DB::table('notifications')
        ->where('resume_id', $id)
        ->where('resume_viewed', '0')
        ->first();
        if($notification) {
            $resumeAccess->resume_viewed = "1";
            $resumeAccess->save();
            DB::table('notifications')
                ->where('resume_id', $id)->update(['resume_viewed' => '1']);

            $activity['byUser'] = Auth::id();
            $activity['forUser'] = $notification->byUser;
            //$activity['email'] = $userEmail;
            $activity['activity'] = "resume_viewed";
            $activity['created_at'] = date('Y-m-d H:i:s');
            $activity['resume_id'] = $notification->resume_id;
            $activity['request_status'] = 'accepted';
            $activity['is_visible'] = '0';
            Activity::createActivity($activity);
        }

        $user_id = $ownerData->id;
        // inserting view stats
        if(Auth::id()) {
            $insertData['viewed_by'] = Auth::id();
            $insertData['resume_user_id'] = $user_id;
            DB::table('resume_stats')->insert($insertData);
        }

        $data['profileData'] = User::where("id","=",$user_id)->get()->first();

        $data['contactInfo'] = Contact::where("user_id", $user_id)->where("private", '0')->get()->first();
        $data['contactCount'] = Contact::where("user_id","=",$user_id)->where("private", '0')->count();

        $data['objectiveInfo'] = Objective::where("user_id","=",$user_id)->where("private", '0')->get()->first();
        $data['objectiveCount'] = Objective::where("user_id","=",$user_id)->where("private", '0')->count();

        $data['currentAddressInfo'] = Address::where("user_id","=", $user_id)->where("private", '0')->where("type","0")->get()->first();
        $data['currentAddressCount'] = Address::where("user_id","=", $user_id)->where("private", '0')->where("type","0")->count();

        $data['permanentAddressInfo'] = Address::where("user_id","=", $user_id)->where("private", '0')->where("type","1")->get()->first();
        $data['permanentAddressCount'] = Address::where("user_id","=", $user_id)->where("private", '0')->where("type","1")->count();

        $data['workInfo']  = Work::where("user_id","=", $user_id)->where("private", '0')->orderBy('workStartDate', 'desc')->orderBy('employementType', 'asc')->get();
        $data['workCount'] = Work::where("user_id","=", $user_id)->where("private", '0')->count();

        $data['currentWorkInfo']  = Work::where("user_id","=", $user_id)->where("private", '0')->where("employementStatus","=","1")->get()->first();
        $data['currentWorkCount']  = Work::where("user_id","=", $user_id)->where("private", '0')->where("employementStatus","=","1")->count();


        if($data['workCount'] > 0 ){
            if($data['workInfo'][0]->workEndDate!='0000-00-00 00:00:00'){
                $data['workEnding'] = $data['workInfo'][0]->workEndDate;
            }else{
                $data['workEnding'] = date('Y-m-d H:i:s');
            }
            $ending = array();
            $current = 0;
            $start = array();
            foreach ($data['workInfo'] as $key => $work) {
                if($work->workEndDate!='0000-00-00 00:00:00'){
                    $data['workInfo'][$key]['duration'] = $this->dateDiffrence($work->workStartDate,$work->workEndDate);
                }else{
                    $data['workInfo'][$key]['duration'] = $this->dateDiffrence($work->workStartDate,date('Y-m-d H:i:s'));
                }
                $data['workStarting'] = $work->workStartDate;
                $start[$key] = $work->workStartDate;
                $ending[$key] = $work->workEndDate;
                if($work->employementStatus == "1") {
                    $current++;
                }

            }

            usort($start, 'dateSort');
            usort($ending, 'dateSort');
            $data['workStarting']  = $start[0];
            if($current) {
                $data['workEnding'] = date('Y-m-d H:i:s');
            } else {
                $data['workEnding'] =  $ending[count($ending)-1];
            }

            $data['totalWorkDuration'] = $this->dateDiffrence($data['workStarting'],$data['workEnding']);
        }
        $data['education'] = array('1' => 'Post graduation', '2' => 'Graduation', '3' => 'Under graduation');

        $data['educationInfo'] = Education::where("user_id","=", $user_id)->where("private", '0')->orderBy('educationDate', 'desc')->get();
        $data['educationCount'] = Education::where("user_id","=", $user_id)->where("private", '0')->count();

        $data['projectInfo'] = Project::where("user_id","=", $user_id)->where("private", '0')->get();
        $data['projectCount'] = Project::where("user_id","=", $user_id)->where("private", '0')->count();

        $data['skillInfo'] = Skill::where("user_id","=", $user_id)->get()->where("private", '0')->first();
        $data['skillCount'] = Skill::where("user_id","=", $user_id)->where("private", '0')->count();

        $data['softskillInfo'] = Softskills::where("user_id","=", $user_id)->where("private", '0')->first();
        $data['softskillCount'] = Softskills::where("user_id","=", $user_id)->where("private", '0')->count();

        $data['certificationInfo'] = Certification::where("user_id","=", $user_id)->where("private", '0')->get();
        $data['certificationCount'] = Certification::where("user_id","=", $user_id)->where("private", '0')->count();

        $data['trainingInfo'] = Training::where("user_id","=", $user_id)->where("private", '0')->get();
        $data['trainingCount'] = Training::where("user_id","=", $user_id)->where("private", '0')->count();

        $data['courseInfo'] = Course::where("user_id","=", $user_id)->where("private", '0')->get();
        $data['courseCount'] = Course::where("user_id","=", $user_id)->where("private", '0')->count();



        $data['awardInfo']  = Award::where("user_id","=", $user_id)->where("private", '0')->get();
        $data['awardCount'] = Award::where("user_id","=", $user_id)->where("private", '0')->count();

        $data['patentInfo']  = Patent::where("user_id","=", $user_id)->where("private", '0')->get();
        $data['patentCount'] = Patent::where("user_id","=", $user_id)->where("private", '0')->count();

        $data['languageInfo']  = Language::where("user_id","=", $user_id)->where("private", '0')->get();
        $data['languageCount'] = Language::where("user_id","=", $user_id)->where("private", '0')->count();

        $data['referenceInfo']  = Reference::where("user_id","=", $user_id)->where("private", '0')->get();
        $data['referenceCount'] = Reference::where("user_id","=", $user_id)->where("private", '0')->count();

        $data['basicInfo']  = UserBasicInformations::where("user_id","=", $user_id)->orderBy('updated_at', 'desc')->first();
        $data['basicInfoCount'] = UserBasicInformations::where("user_id","=", $user_id)->count();

        $data['coverNote']  = Resumetitle::where("user_id","=", $user_id)->orderBy('updated_at', 'desc')->first();
        $data['coverNoteCount'] = Resumetitle::where("user_id","=", $user_id)->count();

        $data['miscellaneousInfo']  = DB::table('travels as TR')
                                        ->join('work_categories as WC', 'WC.id', '=', 'TR.work_category')
                                        ->where("TR.user_id", "=", $user_id)

                                        ->orderBy('TR.yyyyEnd', 'asc')
                                        ->get(['*', 'TR.id as id']);
        $data['miscellaneousCount'] = Travel::where("user_id","=", $user_id)->count();

        $data['interestInfo'] = Interests::where("user_id","=", $user_id)->first();
        $data['interestCount'] = Interests::where("user_id","=", $user_id)->count();

        return view('resume.resume',$data);

    }
    // end resume view passcode

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

        function download() {
            $data['print_hide'] = 0;

            $ownerEmail = Auth::user()->email;
            $data["resumeAccess"] = $resumeAccess = Resume::where("ownerEmail","=",$ownerEmail)->get()->first();
            $user_id = Auth::id();

            $data['profileData'] = User::where("id","=",$user_id)->where("profilePrivate", '0')->get()->first();

            $data['contactInfo'] = Contact::where("user_id", $user_id)->where("private", '0')->get()->first();
            $data['contactCount'] = Contact::where("user_id","=",$user_id)->where("private", '0')->count();

            $data['objectiveInfo'] = Objective::where("user_id","=",$user_id)->where("private", '0')->get()->first();
            $data['objectiveCount'] = Objective::where("user_id","=",$user_id)->where("private", '0')->count();

            $data['currentAddressInfo'] = Address::where("user_id","=", Auth::id())->where("private", '0')->where("type","0")->get()->first();
            $data['currentAddressCount'] = Address::where("user_id","=", Auth::id())->where("private", '0')->where("type","0")->count();

            $data['permanentAddressInfo'] = Address::where("user_id","=", Auth::id())->where("private", '0')->where("type","1")->get()->first();
            $data['permanentAddressCount'] = Address::where("user_id","=", Auth::id())->where("private", '0')->where("type","1")->count();

            $data['workInfo']  = Work::where("user_id","=", Auth::id())->where("private", '0')->orderBy('workStartDate', 'desc')->orderBy('employementType', 'asc')->get();
            $data['workCount'] = Work::where("user_id","=", Auth::id())->where("private", '0')->count();

            $data['currentWorkInfo']  = Work::where("user_id","=", Auth::id())->where("private", '0')->where("employementStatus","=","1")->get()->first();
            $data['currentWorkCount']  = Work::where("user_id","=", Auth::id())->where("private", '0')->where("employementStatus","=","1")->count();


            if($data['workCount'] > 0 ){
                if($data['workInfo'][0]->workEndDate!='0000-00-00 00:00:00'){
                    $data['workEnding'] = $data['workInfo'][0]->workEndDate;
                }else{
                    $data['workEnding'] = date('Y-m-d H:i:s');
                }
                $ending = array();
                $current = 0;
                $start = array();
                foreach ($data['workInfo'] as $key => $work) {
                    if($work->workEndDate!='0000-00-00 00:00:00'){
                        $data['workInfo'][$key]['duration'] = $this->dateDiffrence($work->workStartDate,$work->workEndDate);
                    }else{
                        $data['workInfo'][$key]['duration'] = $this->dateDiffrence($work->workStartDate,date('Y-m-d H:i:s'));
                    }
                    $data['workStarting'] = $work->workStartDate;
                    $start[$key] = $work->workStartDate;
                    $ending[$key] = $work->workEndDate;
                    if($work->employementStatus == "1") {
                        $current++;
                    }

                }

                usort($start, 'dateSort');
                usort($ending, 'dateSort');
                $data['workStarting']  = $start[0];
                if($current) {
                    $data['workEnding'] = date('Y-m-d H:i:s');
                } else {
                    $data['workEnding'] =  $ending[count($ending)-1];
                }

                $data['totalWorkDuration'] = $this->dateDiffrence($data['workStarting'],$data['workEnding']);
            }
            $data['education'] = array('1' => 'Post graduation', '2' => 'Graduation', '3' => 'Under graduation');

            $data['educationInfo'] = Education::where("user_id","=", Auth::id())->where("private", '0')->orderBy('educationDate', 'desc')->get();
            $data['educationCount'] = Education::where("user_id","=", Auth::id())->where("private", '0')->count();

            $data['projectInfo'] = Project::where("user_id","=", Auth::id())->where("private", '0')->get();
            $data['projectCount'] = Project::where("user_id","=", Auth::id())->where("private", '0')->count();

            $data['skillInfo'] = Skill::where("user_id","=", Auth::id())->get()->where("private", '0')->first();
            $data['skillCount'] = Skill::where("user_id","=", Auth::id())->where("private", '0')->count();

            $data['softskillInfo'] = Softskills::where("user_id","=", Auth::id())->where("private", '0')->first();
            $data['softskillCount'] = Softskills::where("user_id","=", Auth::id())->where("private", '0')->count();

            $data['certificationInfo'] = Certification::where("user_id","=", Auth::id())->where("private", '0')->get();
            $data['certificationCount'] = Certification::where("user_id","=", Auth::id())->where("private", '0')->count();

            $data['trainingInfo'] = Training::where("user_id","=", Auth::id())->where("private", '0')->get();
            $data['trainingCount'] = Training::where("user_id","=", Auth::id())->where("private", '0')->count();

            $data['courseInfo'] = Course::where("user_id","=", Auth::id())->where("private", '0')->get();
            $data['courseCount'] = Course::where("user_id","=", Auth::id())->where("private", '0')->count();



            $data['awardInfo']  = Award::where("user_id","=", Auth::id())->where("private", '0')->get();
            $data['awardCount'] = Award::where("user_id","=", Auth::id())->where("private", '0')->count();

            $data['patentInfo']  = Patent::where("user_id","=", Auth::id())->where("private", '0')->get();
            $data['patentCount'] = Patent::where("user_id","=", Auth::id())->where("private", '0')->count();

            $data['languageInfo']  = Language::where("user_id","=", Auth::id())->where("private", '0')->get();
            $data['languageCount'] = Language::where("user_id","=", Auth::id())->where("private", '0')->count();

            $data['referenceInfo']  = Reference::where("user_id","=", Auth::id())->where("private", '0')->get();
            $data['referenceCount'] = Reference::where("user_id","=", Auth::id())->where("private", '0')->count();

            $data['basicInfo']  = UserBasicInformations::where("user_id","=", Auth::id())->orderBy('updated_at', 'desc')->first();
            $data['basicInfoCount'] = UserBasicInformations::where("user_id","=", Auth::id())->count();

            $data['coverNote']  = Resumetitle::where("user_id","=", Auth::id())->orderBy('updated_at', 'desc')->first();
            $data['coverNoteCount'] = Resumetitle::where("user_id","=", Auth::id())->count();

            $data['miscellaneousInfo']  = DB::table('travels as TR')
                                            ->join('work_categories as WC', 'WC.id', '=', 'TR.work_category')
                                            ->where("TR.user_id", "=", Auth::id())

                                            ->orderBy('TR.yyyyEnd', 'asc')
                                            ->get(['*', 'TR.id as id']);
            $data['miscellaneousCount'] = Travel::where("user_id","=", Auth::id())->count();

            $data['interestInfo'] = Interests::where("user_id","=", Auth::id())->first();
            $data['interestCount'] = Interests::where("user_id","=", Auth::id())->count();
            return view('resume.resume_pd', $data);
            //$pdf = PDF::loadView('resume.resume_pd', $data);
            //$file_name = str_replace(' ', '_', Auth::user()->first_name."_".Auth::user()->last_name)."_resume".date('m-d-Y');
            //return $pdf->download($file_name.'.pdf');
        }

        function downloadDoc() {
            $data['print_hide'] = 0;
            $ownerEmail = Auth::user()->email;
            $data["resumeAccess"] = $resumeAccess = Resume::where("ownerEmail","=",$ownerEmail)->get()->first();
            $user_id = Auth::id();

            $data['profileData'] = User::where("id","=",$user_id)->where("profilePrivate", '0')->get()->first();

            $data['contactInfo'] = Contact::where("user_id", $user_id)->where("private", '0')->get()->first();
            $data['contactCount'] = Contact::where("user_id","=",$user_id)->where("private", '0')->count();

            $data['objectiveInfo'] = Objective::where("user_id","=",$user_id)->where("private", '0')->get()->first();
            $data['objectiveCount'] = Objective::where("user_id","=",$user_id)->where("private", '0')->count();

            $data['currentAddressInfo'] = Address::where("user_id","=", Auth::id())->where("private", '0')->where("type","0")->get()->first();
            $data['currentAddressCount'] = Address::where("user_id","=", Auth::id())->where("private", '0')->where("type","0")->count();

            $data['permanentAddressInfo'] = Address::where("user_id","=", Auth::id())->where("private", '0')->where("type","1")->get()->first();
            $data['permanentAddressCount'] = Address::where("user_id","=", Auth::id())->where("private", '0')->where("type","1")->count();

            $data['workInfo']  = Work::where("user_id","=", Auth::id())->where("private", '0')->orderBy('workStartDate', 'desc')->orderBy('employementType', 'asc')->get();
            $data['workCount'] = Work::where("user_id","=", Auth::id())->where("private", '0')->count();

            $data['currentWorkInfo']  = Work::where("user_id","=", Auth::id())->where("private", '0')->where("employementStatus","=","1")->get()->first();
            $data['currentWorkCount']  = Work::where("user_id","=", Auth::id())->where("private", '0')->where("employementStatus","=","1")->count();


            if($data['workCount'] > 0 ){
                if($data['workInfo'][0]->workEndDate!='0000-00-00 00:00:00'){
                    $data['workEnding'] = $data['workInfo'][0]->workEndDate;
                }else{
                    $data['workEnding'] = date('Y-m-d H:i:s');
                }
                $ending = array();
                $current = 0;
                $start = array();
                foreach ($data['workInfo'] as $key => $work) {
                    if($work->workEndDate!='0000-00-00 00:00:00'){
                        $data['workInfo'][$key]['duration'] = $this->dateDiffrence($work->workStartDate,$work->workEndDate);
                    }else{
                        $data['workInfo'][$key]['duration'] = $this->dateDiffrence($work->workStartDate,date('Y-m-d H:i:s'));
                    }
                    $data['workStarting'] = $work->workStartDate;
                    $start[$key] = $work->workStartDate;
                    $ending[$key] = $work->workEndDate;
                    if($work->employementStatus == "1") {
                        $current++;
                    }

                }

                usort($start, 'dateSort');
                usort($ending, 'dateSort');
                $data['workStarting']  = $start[0];
                if($current) {
                    $data['workEnding'] = date('Y-m-d H:i:s');
                } else {
                    $data['workEnding'] =  $ending[count($ending)-1];
                }

                $data['totalWorkDuration'] = $this->dateDiffrence($data['workStarting'],$data['workEnding']);
            }
            $data['education'] = array('1' => 'Post graduation', '2' => 'Graduation', '3' => 'Under graduation');

            $data['educationInfo'] = Education::where("user_id","=", Auth::id())->where("private", '0')->orderBy('educationDate', 'desc')->get();
            $data['educationCount'] = Education::where("user_id","=", Auth::id())->where("private", '0')->count();

            $data['projectInfo'] = Project::where("user_id","=", Auth::id())->where("private", '0')->get();
            $data['projectCount'] = Project::where("user_id","=", Auth::id())->where("private", '0')->count();

            $data['skillInfo'] = Skill::where("user_id","=", Auth::id())->get()->where("private", '0')->first();
            $data['skillCount'] = Skill::where("user_id","=", Auth::id())->where("private", '0')->count();

            $data['softskillInfo'] = Softskills::where("user_id","=", Auth::id())->where("private", '0')->first();
            $data['softskillCount'] = Softskills::where("user_id","=", Auth::id())->where("private", '0')->count();

            $data['certificationInfo'] = Certification::where("user_id","=", Auth::id())->where("private", '0')->get();
            $data['certificationCount'] = Certification::where("user_id","=", Auth::id())->where("private", '0')->count();

            $data['trainingInfo'] = Training::where("user_id","=", Auth::id())->where("private", '0')->get();
            $data['trainingCount'] = Training::where("user_id","=", Auth::id())->where("private", '0')->count();

            $data['courseInfo'] = Course::where("user_id","=", Auth::id())->where("private", '0')->get();
            $data['courseCount'] = Course::where("user_id","=", Auth::id())->where("private", '0')->count();



            $data['awardInfo']  = Award::where("user_id","=", Auth::id())->where("private", '0')->get();
            $data['awardCount'] = Award::where("user_id","=", Auth::id())->where("private", '0')->count();

            $data['patentInfo']  = Patent::where("user_id","=", Auth::id())->where("private", '0')->get();
            $data['patentCount'] = Patent::where("user_id","=", Auth::id())->where("private", '0')->count();

            $data['languageInfo']  = Language::where("user_id","=", Auth::id())->where("private", '0')->get();
            $data['languageCount'] = Language::where("user_id","=", Auth::id())->where("private", '0')->count();

            $data['referenceInfo']  = Reference::where("user_id","=", Auth::id())->where("private", '0')->get();
            $data['referenceCount'] = Reference::where("user_id","=", Auth::id())->where("private", '0')->count();

            $data['basicInfo']  = UserBasicInformations::where("user_id","=", Auth::id())->orderBy('updated_at', 'desc')->first();
            $data['basicInfoCount'] = UserBasicInformations::where("user_id","=", Auth::id())->count();

            $data['coverNote']  = Resumetitle::where("user_id","=", Auth::id())->orderBy('updated_at', 'desc')->first();
            $data['coverNoteCount'] = Resumetitle::where("user_id","=", Auth::id())->count();

            $data['miscellaneousInfo']  = DB::table('travels as TR')
                                            ->join('work_categories as WC', 'WC.id', '=', 'TR.work_category')
                                            ->where("TR.user_id", "=", Auth::id())

                                            ->orderBy('TR.yyyyEnd', 'asc')
                                            ->get(['*', 'TR.id as id']);
            $data['miscellaneousCount'] = Travel::where("user_id","=", Auth::id())->count();

            $data['interestInfo'] = Interests::where("user_id","=", Auth::id())->first();
            $data['interestCount'] = Interests::where("user_id","=", Auth::id())->count();
            header("Content-type: application/vnd.ms-word");
            header("Content-Disposition: attachment; Filename=yourcoolwordfile.doc");
            print(html_entity_decode(view('resume.download', $data)));
            return response()->download('helloWorld.docx');

        }

        function printPreview() {
            $data['print_hide'] = 1;
            $ownerEmail = Auth::user()->email;
            $data["resumeAccess"] = $resumeAccess = Resume::where("ownerEmail","=",$ownerEmail)->get()->first();
            $user_id = Auth::id();

            $data['profileData'] = User::where("id","=",$user_id)->where("profilePrivate", '0')->get()->first();

            $data['contactInfo'] = Contact::where("user_id", $user_id)->where("private", '0')->get()->first();
            $data['contactCount'] = Contact::where("user_id","=",$user_id)->where("private", '0')->count();

            $data['objectiveInfo'] = Objective::where("user_id","=",$user_id)->where("private", '0')->get()->first();
            $data['objectiveCount'] = Objective::where("user_id","=",$user_id)->where("private", '0')->count();

            $data['currentAddressInfo'] = Address::where("user_id","=", Auth::id())->where("private", '0')->where("type","0")->get()->first();
            $data['currentAddressCount'] = Address::where("user_id","=", Auth::id())->where("private", '0')->where("type","0")->count();

            $data['permanentAddressInfo'] = Address::where("user_id","=", Auth::id())->where("private", '0')->where("type","1")->get()->first();
            $data['permanentAddressCount'] = Address::where("user_id","=", Auth::id())->where("private", '0')->where("type","1")->count();

            $data['workInfo']  = Work::where("user_id","=", Auth::id())->where("private", '0')->orderBy('workStartDate', 'desc')->orderBy('employementType', 'asc')->get();
            $data['workCount'] = Work::where("user_id","=", Auth::id())->where("private", '0')->count();

            $data['currentWorkInfo']  = Work::where("user_id","=", Auth::id())->where("private", '0')->where("employementStatus","=","1")->get()->first();
            $data['currentWorkCount']  = Work::where("user_id","=", Auth::id())->where("private", '0')->where("employementStatus","=","1")->count();

            if($data['workCount'] > 0 ){
                if($data['workInfo'][0]->workEndDate!='0000-00-00 00:00:00'){
                    $data['workEnding'] = $data['workInfo'][0]->workEndDate;
                }else{
                    $data['workEnding'] = date('Y-m-d H:i:s');
                }
                $ending = array();
                $current = 0;
                $start = array();
                foreach ($data['workInfo'] as $key => $work) {
                    if($work->workEndDate!='0000-00-00 00:00:00'){
                        $data['workInfo'][$key]['duration'] = $this->dateDiffrence($work->workStartDate,$work->workEndDate);
                    }else{
                        $data['workInfo'][$key]['duration'] = $this->dateDiffrence($work->workStartDate,date('Y-m-d H:i:s'));
                    }
                    $data['workStarting'] = $work->workStartDate;
                    $start[$key] = $work->workStartDate;
                    $ending[$key] = $work->workEndDate;
                    if($work->employementStatus == "1") {
                        $current++;
                    }

                }

                usort($start, 'dateSort');
                usort($ending, 'dateSort');
                $data['workStarting']  = $start[0];
                if($current) {
                    $data['workEnding'] = date('Y-m-d H:i:s');
                } else {
                    $data['workEnding'] =  $ending[count($ending)-1];
                }

                $data['totalWorkDuration'] = $this->dateDiffrence($data['workStarting'],$data['workEnding']);
            }
            $data['education'] = array('1' => 'Post graduation', '2' => 'Graduation', '3' => 'Under graduation');

            $data['educationInfo'] = Education::where("user_id","=", Auth::id())->where("private", '0')->orderBy('educationDate', 'desc')->get();
            $data['educationCount'] = Education::where("user_id","=", Auth::id())->where("private", '0')->count();

            $data['projectInfo'] = Project::where("user_id","=", Auth::id())->where("private", '0')->get();
            $data['projectCount'] = Project::where("user_id","=", Auth::id())->where("private", '0')->count();

            $data['skillInfo'] = Skill::where("user_id","=", Auth::id())->get()->where("private", '0')->first();
            $data['skillCount'] = Skill::where("user_id","=", Auth::id())->where("private", '0')->count();

            $data['softskillInfo'] = Softskills::where("user_id","=", Auth::id())->where("private", '0')->first();
            $data['softskillCount'] = Softskills::where("user_id","=", Auth::id())->where("private", '0')->count();

            $data['certificationInfo'] = Certification::where("user_id","=", Auth::id())->where("private", '0')->get();
            $data['certificationCount'] = Certification::where("user_id","=", Auth::id())->where("private", '0')->count();

            $data['trainingInfo'] = Training::where("user_id","=", Auth::id())->where("private", '0')->get();
            $data['trainingCount'] = Training::where("user_id","=", Auth::id())->where("private", '0')->count();

            $data['courseInfo'] = Course::where("user_id","=", Auth::id())->where("private", '0')->get();
            $data['courseCount'] = Course::where("user_id","=", Auth::id())->where("private", '0')->count();



            $data['awardInfo']  = Award::where("user_id","=", Auth::id())->where("private", '0')->get();
            $data['awardCount'] = Award::where("user_id","=", Auth::id())->where("private", '0')->count();

            $data['patentInfo']  = Patent::where("user_id","=", Auth::id())->where("private", '0')->get();
            $data['patentCount'] = Patent::where("user_id","=", Auth::id())->where("private", '0')->count();

            $data['languageInfo']  = Language::where("user_id","=", Auth::id())->where("private", '0')->get();
            $data['languageCount'] = Language::where("user_id","=", Auth::id())->where("private", '0')->count();

            $data['referenceInfo']  = Reference::where("user_id","=", Auth::id())->where("private", '0')->get();
            $data['referenceCount'] = Reference::where("user_id","=", Auth::id())->where("private", '0')->count();

            $data['basicInfo']  = UserBasicInformations::where("user_id","=", Auth::id())->orderBy('updated_at', 'desc')->first();
            $data['basicInfoCount'] = UserBasicInformations::where("user_id","=", Auth::id())->count();

            $data['coverNote']  = Resumetitle::where("user_id","=", Auth::id())->orderBy('updated_at', 'desc')->first();
            $data['coverNoteCount'] = Resumetitle::where("user_id","=", Auth::id())->count();

            $data['miscellaneousInfo']  = DB::table('travels as TR')
                                            ->join('work_categories as WC', 'WC.id', '=', 'TR.work_category')
                                            ->where("TR.user_id", "=", Auth::id())

                                            ->orderBy('TR.yyyyEnd', 'asc')
                                            ->get(['*', 'TR.id as id']);
            $data['miscellaneousCount'] = Travel::where("user_id","=", Auth::id())->count();

            $data['interestInfo'] = Interests::where("user_id","=", Auth::id())->first();
            $data['interestCount'] = Interests::where("user_id","=", Auth::id())->count();

            return view('resume.download', $data);
        }

        public function track() {
            DB::table('notifications')
                ->orWhere('forUser', Auth::id())
                ->orWhere('forUser', Auth::user()->email)
                ->update(['readStatus'=> '1']);
            $user_id = Auth::id();
            $email = Auth::user()->email;
            $data['activities'] = Activity::getUserActivities($user_id, $email);
            return view('resume.resume_track', $data);
        }

        public function verifyPasscode(Request $request){
            $input = $request->all();
            $json['error'] = false;
            $json['errorMsg'] = "";
            $url = explode("-", $input['url']);
            $id = end($url);
            $passcode = $input['n1'].$input['n2'].$input['n3'].$input['n4'].$input['n5'].$input['n6'];
            $data["resumeAccess"] = $resumeAccess = Resume::where('id','=',$id)->get()->first();
            if(!$data["resumeAccess"] || $id == '0') {
                $json['errorMsg'] = "Invalid passkey";
                $json['error'] = true;
            }
            $ownerData = User::where("email","=",$resumeAccess['ownerEmail'])->get()->first();
            if($ownerData->resume_passcode != $passcode) {
                $json['errorMsg'] = "Invalid passkey";
                $json['error'] = true;
            }
            if($json['error']==false) {
                $json['passcode'] = $passcode;
            }
            return response()->json($json);

        }

        // update activity
        function requestResumeUpdate(Request $request) {
            $json['error'] = true;
            $json ['errorMsg'] = "";
            $input = $request->all();
            $activity = Activity::getUserActivityById($input['req_id']);
            if($activity && $input['status'] == 'rejected') {
                DB::table('notifications')
                ->where('id', $input['req_id'])
                ->update(array('request_status' => $input['status'], 'is_visible' => '0'));
                $json['error'] = false;
            } elseif($activity && $input['status'] == 'cancel') {
                DB::table('notifications')
                ->where('id', $input['req_id'])
                ->update(['is_visible' => '0']);

                $json['error'] = false;
            } else {
                $resume = DB::table('resumes')->where('ownerEmail', $activity->email)->first();
                if($resume) {
                    $user = DB::table('users')->where('id', $activity->byUser)->first();
                    $activity1['email'] = Auth::user()->email;
                    $activity1['resume_id'] = $resume->id;
                    $activity1['request_status'] = 'accepted';
                    $url = str_replace(" ", "-", Auth::user()->first_name."-".Auth::user()->last_name)."-".$resume->id."/".$this->changePasscode();
                    DB::table('notifications')
                    ->where('id', $input['req_id'])
                    ->update(array('request_status' => $input['status'], 'resume_id' => $resume->id, 'is_visible' => '0'));
                    DB::table('resumes')->where('id', $resume->id)->update(array('request_status' => $input['status'], 'resume_url' => $url));
                    Email::sendAcceptResumeResp($user->email,$resume->ownerEmail, Auth::user()->first_name);
                    $json['error'] = false;
                } else {
                    $json ['errorMsg'] = "User resume is not created yet";
                }
            }
            if($json['errorMsg']  == "" && $input['status'] != 'cancel') {
                $activity1['byUser'] = Auth::id();
                $activity1['forUser'] = $activity->byUser;
                $activity1['activity'] = $input['status'] == 'rejected' ? 'resume_rejected' : 'resume_accepted';


                $activity1['created_at'] = date('Y-m-d H:i:s');
                Activity::createActivity($activity1);
            }
            return response()->json($json);

        }
        // resume view activity
        function viewResumeActivity(Request $request) {
            $json['error'] = true;
            $json ['errorMsg'] = "";
            $input = $request->all();
            $activity = Activity::getUserActivityById($input['req_id']);
            if($activity && $activity->request_status == 'accepted' && $activity->resume_id != '') {

                $resume = DB::table('resumes')->where('id', $activity->resume_id)->first();

                $json['url'] = $resume->resume_url;
                $json['error'] = false;
            } else {
                $json ['errorMsg'] = "Invalid data supplied";
            }
            return response()->json($json);

        }

    function requestResume() {
        $data['countryNameList'] = ["Afghanistan","Albania","Algeria","American Samoa","Andorra","Angola","Anguilla","Antarctica","Antigua and Barbuda","Argentina","Armenia","Aruba","Australia","Austria","Azerbaijan","Bahamas","Bahrain","Bangladesh","Barbados","Belarus","Belgium","Belize","Benin","Bermuda","Bhutan","Bolivia","Bosnia and Herzegovina","Botswana","Brazil","British Indian Ocean Territory","British Virgin Islands","Brunei","Bulgaria","Burkina Faso","Burundi","Cambodia","Cameroon","Canada","Cape Verde","Cayman Islands","Central African Republic","Chad","Chile","China","Christmas Island","Cocos Islands","Colombia","Comoros","Cook Islands","Costa Rica","Croatia","Cuba","Curacao","Cyprus","Czech Republic","Democratic Republic of the Congo","Denmark","Djibouti","Dominica","Dominican Republic","East Timor","Ecuador","Egypt","El Salvador","Equatorial Guinea","Eritrea","Estonia","Ethiopia","Falkland Islands","Faroe Islands","Fiji","Finland","France","French Polynesia","Gabon","Gambia","Georgia","Germany","Ghana","Gibraltar","Greece","Greenland","Grenada","Guam","Guatemala","Guernsey","Guinea","Guinea-Bissau","Guyana","Haiti","Honduras","Hong Kong","Hungary","Iceland","India","Indonesia","Iran","Iraq","Ireland","Isle of Man","Israel","Italy","Ivory Coast","Jamaica","Japan","Jersey","Jordan","Kazakhstan","Kenya","Kiribati","Kosovo","Kuwait","Kyrgyzstan","Laos","Latvia","Lebanon","Lesotho","Liberia","Libya","Liechtenstein","Lithuania","Luxembourg","Macau","Macedonia","Madagascar","Malawi","Malaysia","Maldives","Mali","Malta","Marshall Islands","Mauritania","Mauritius","Mayotte","Mexico","Micronesia","Moldova","Monaco","Mongolia","Montenegro","Montserrat","Morocco","Mozambique","Myanmar","Namibia","Nauru","Nepal","Netherlands","Netherlands Antilles","New Caledonia","New Zealand","Nicaragua","Niger","Nigeria","Niue","North Korea","Northern Mariana Islands","Norway","Oman","Pakistan","Palau","Palestine","Panama","Papua New Guinea","Paraguay","Peru","Philippines","Pitcairn","Poland","Portugal","Puerto Rico","Qatar","Republic of the Congo","Reunion","Romania","Russia","Rwanda","Saint Barthelemy","Saint Helena","Saint Kitts and Nevis","Saint Lucia","Saint Martin","Saint Pierre and Miquelon","Saint Vincent and the Grenadines","Samoa","San Marino","Sao Tome and Principe","Saudi Arabia","Senegal","Serbia","Seychelles","Sierra Leone","Singapore","Sint Maarten","Slovakia","Slovenia","Solomon Islands","Somalia","South Africa","South Korea","South Sudan","Spain","Sri Lanka","Sudan","Suriname","Svalbard and Jan Mayen","Swaziland","Sweden","Switzerland","Syria","Taiwan","Tajikistan","Tanzania","Thailand","Togo","Tokelau","Tonga","Trinidad and Tobago","Tunisia","Turkey","Turkmenistan","Turks and Caicos Islands","Tuvalu","U.S. Virgin Islands","Uganda","Ukraine","United Arab Emirates","United Kingdom","United States","Uruguay","Uzbekistan","Vanuatu","Vatican","Venezuela","Vietnam","Wallis and Futuna","Western Sahara","Yemen","Zambia","Zimbabwe"];
    	$data['countryCodeList'] = ["93","355","213","1-684","376","244","1-264","672","1-268","54","374","297","61","43","994","1-242","973","880","1-246","375","32","501","229","1-441","975","591","387","267","55","246","1-284","673","359","226","257","855","237","1","238","1-345","236","235","56","86","61","61","57","269","682","506","385","53","599","357","420","243","45","253","1-767","1-809, 1-829, 1-849","670","593","20","503","240","291","372","251","500","298","679","358","33","689","241","220","995","49","233","350","30","299","1-473","1-671","502","44-1481","224","245","592","509","504","852","36","354","91","62","98","964","353","44-1624","972","39","225","1-876","81","44-1534","962","7","254","686","383","965","996","856","371","961","266","231","218","423","370","352","853","389","261","265","60","960","223","356","692","222","230","262","52","691","373","377","976","382","1-664","212","258","95","264","674","977","31","599","687","64","505","227","234","683","850","1-670","47","968","92","680","970","507","675","595","51","63","64","48","351","1-787, 1-939","974","242","262","40","7","250","590","290","1-869","1-758","590","508","1-784","685","378","239","966","221","381","248","232","65","1-721","421","386","677","252","27","82","211","34","94","249","597","47","268","46","41","963","886","992","255","66","228","690","676","1-868","216","90","993","1-649","688","1-340","256","380","971","44","1","598","998","678","379","58","84","681","212","967","260","263"];
        return view('resume.request_resume', $data);
    }

    function requestResumeSave(Request $request) {
        $json['error'] = true;
        $json['errorMsg'] = "";
        $json['invite_user'] = '0';
        $input = $request->all();
        if($input['option'] == 'email') {
            $user = DB::table('users')->where('email', $input['email'])->first();
            // matching if user is requesting self resume
            if($user) {
                if($user->id == Auth::id()) {
                    $json['errorMsg'] = "You can not send request to yourself";
                    return response()->json($json);
                }
            // checking if request resume is already in pedning state

            $pendingReq =  DB::table('notifications')->where('byUser', Auth::id())
                                    ->where('email', $input['email'])
                                    ->where('activity', 'resume_request')
                                    ->where('request_status', '!=', 'accepted')
                                    ->first();
            // if request is already pending then end process here with flash message
            if($pendingReq) {
                $json['errorMsg'] = "Your request is accepted or pending to view.";
                return response()->json($json);
            }
                $activity['byUser'] = Auth::id();
                $activity['forUser'] = $user->id;
                $activity['activity'] = 'resume_request';
                $activity['email'] = $user->email;
                $activity['created_at'] = date('Y-m-d H:i:s');
                Activity::createActivity($activity);
                $request->session()->flash('success', 'Request has been sent successfully!');
                Email::sendResumeRequest($input['email'], Auth::user()->email, Auth::user()->first_name, $input['message']);
                $json['error'] = false;
            } else {

                $activity['byUser'] = Auth::id();
                //$activity['forUser'] = $user->id;
                $activity['activity'] = 'resume_request';
                $activity['email'] = $input['email'];
                $activity['created_at'] = date('Y-m-d H:i:s');
                Activity::createActivity($activity);
                $request->session()->flash('success', 'Request has been sent successfully!');
                $json['invite_user'] = '1';
                //Email::sendResumeRequestInvitation($input['email'],Auth::user()->email, Auth::user()->first_name);
                $json['error'] = false;

            }
        }

        if($input['option'] == 'wmid') {
            $user = DB::table('users')->where('wmid', $input['wmid'])->first();
            if($user) {
                if($user->id == Auth::id()) {
                    $json['errorMsg'] = "You can not send request to yourself";
                    return response()->json($json);
                }
                $activity['byUser'] = Auth::id();
                $activity['forUser'] = $user->id;
                $activity['activty'] = 'resume_request';
                $activity['email'] = $user->email;
                Activity::createActivity($activity);
                $request->session()->flash('success', 'Request has been sent successfully!');
                $json['error'] = false;
            } else {
                $json['errorMsg'] = "WMID not found";

            }

        }
        return response()->json($json);
    }

    function forwardResume($resume_id) {
        $data['countryNameList'] = ["Afghanistan","Albania","Algeria","American Samoa","Andorra","Angola","Anguilla","Antarctica","Antigua and Barbuda","Argentina","Armenia","Aruba","Australia","Austria","Azerbaijan","Bahamas","Bahrain","Bangladesh","Barbados","Belarus","Belgium","Belize","Benin","Bermuda","Bhutan","Bolivia","Bosnia and Herzegovina","Botswana","Brazil","British Indian Ocean Territory","British Virgin Islands","Brunei","Bulgaria","Burkina Faso","Burundi","Cambodia","Cameroon","Canada","Cape Verde","Cayman Islands","Central African Republic","Chad","Chile","China","Christmas Island","Cocos Islands","Colombia","Comoros","Cook Islands","Costa Rica","Croatia","Cuba","Curacao","Cyprus","Czech Republic","Democratic Republic of the Congo","Denmark","Djibouti","Dominica","Dominican Republic","East Timor","Ecuador","Egypt","El Salvador","Equatorial Guinea","Eritrea","Estonia","Ethiopia","Falkland Islands","Faroe Islands","Fiji","Finland","France","French Polynesia","Gabon","Gambia","Georgia","Germany","Ghana","Gibraltar","Greece","Greenland","Grenada","Guam","Guatemala","Guernsey","Guinea","Guinea-Bissau","Guyana","Haiti","Honduras","Hong Kong","Hungary","Iceland","India","Indonesia","Iran","Iraq","Ireland","Isle of Man","Israel","Italy","Ivory Coast","Jamaica","Japan","Jersey","Jordan","Kazakhstan","Kenya","Kiribati","Kosovo","Kuwait","Kyrgyzstan","Laos","Latvia","Lebanon","Lesotho","Liberia","Libya","Liechtenstein","Lithuania","Luxembourg","Macau","Macedonia","Madagascar","Malawi","Malaysia","Maldives","Mali","Malta","Marshall Islands","Mauritania","Mauritius","Mayotte","Mexico","Micronesia","Moldova","Monaco","Mongolia","Montenegro","Montserrat","Morocco","Mozambique","Myanmar","Namibia","Nauru","Nepal","Netherlands","Netherlands Antilles","New Caledonia","New Zealand","Nicaragua","Niger","Nigeria","Niue","North Korea","Northern Mariana Islands","Norway","Oman","Pakistan","Palau","Palestine","Panama","Papua New Guinea","Paraguay","Peru","Philippines","Pitcairn","Poland","Portugal","Puerto Rico","Qatar","Republic of the Congo","Reunion","Romania","Russia","Rwanda","Saint Barthelemy","Saint Helena","Saint Kitts and Nevis","Saint Lucia","Saint Martin","Saint Pierre and Miquelon","Saint Vincent and the Grenadines","Samoa","San Marino","Sao Tome and Principe","Saudi Arabia","Senegal","Serbia","Seychelles","Sierra Leone","Singapore","Sint Maarten","Slovakia","Slovenia","Solomon Islands","Somalia","South Africa","South Korea","South Sudan","Spain","Sri Lanka","Sudan","Suriname","Svalbard and Jan Mayen","Swaziland","Sweden","Switzerland","Syria","Taiwan","Tajikistan","Tanzania","Thailand","Togo","Tokelau","Tonga","Trinidad and Tobago","Tunisia","Turkey","Turkmenistan","Turks and Caicos Islands","Tuvalu","U.S. Virgin Islands","Uganda","Ukraine","United Arab Emirates","United Kingdom","United States","Uruguay","Uzbekistan","Vanuatu","Vatican","Venezuela","Vietnam","Wallis and Futuna","Western Sahara","Yemen","Zambia","Zimbabwe"];
    	$data['countryCodeList'] = ["93","355","213","1-684","376","244","1-264","672","1-268","54","374","297","61","43","994","1-242","973","880","1-246","375","32","501","229","1-441","975","591","387","267","55","246","1-284","673","359","226","257","855","237","1","238","1-345","236","235","56","86","61","61","57","269","682","506","385","53","599","357","420","243","45","253","1-767","1-809, 1-829, 1-849","670","593","20","503","240","291","372","251","500","298","679","358","33","689","241","220","995","49","233","350","30","299","1-473","1-671","502","44-1481","224","245","592","509","504","852","36","354","91","62","98","964","353","44-1624","972","39","225","1-876","81","44-1534","962","7","254","686","383","965","996","856","371","961","266","231","218","423","370","352","853","389","261","265","60","960","223","356","692","222","230","262","52","691","373","377","976","382","1-664","212","258","95","264","674","977","31","599","687","64","505","227","234","683","850","1-670","47","968","92","680","970","507","675","595","51","63","64","48","351","1-787, 1-939","974","242","262","40","7","250","590","290","1-869","1-758","590","508","1-784","685","378","239","966","221","381","248","232","65","1-721","421","386","677","252","27","82","211","34","94","249","597","47","268","46","41","963","886","992","255","66","228","690","676","1-868","216","90","993","1-649","688","1-340","256","380","971","44","1","598","998","678","379","58","84","681","212","967","260","263"];
        $data['resumeAccess'] = Resume::where("id",$resume_id)->first();
        $data['ownerData'] = User::where("email","=",$data['resumeAccess']->ownerEmail)->get()->first();
        return view('resume.forwardresume',$data);
    }

    public function forwardResumeSave(Request $request){
        $input = $request->all();
        $input['subject'] = Auth::user()->first_name." ".Auth::user()->last_name. " forwarded his resume to you";
        $updateFlag = 0;

        $userEmail = $input['email'];
        $sharedArray = Resume::where("id",$input['id'])->first();
        $ownerEmail = $sharedArray->ownerEmail;

        if($sharedArray) {
            $sharedArray = $sharedArray->toArray();
            foreach($sharedArray as $key => $share)  {
                if($key!='id' && $key!= 'ownerEmail' && $key!= 'userEmail' && $key!= 'created_at' && $key != 'updated_at')
                    $shareData['shareData'][$key] = $share;
            }
        } else {
            $json['error'] = 1;
            $json['error_msg'] = "Please complete your resume first";
            return response()->json($json);
        }

        $shareData['shareData']['is_secure'] = '0';
        $checkExistingResume = Resume::where("ownerEmail","=",$ownerEmail)->where("userEmail","=",$userEmail)->get()->count();
        if($checkExistingResume <= 0){
            $updateFlag = 0;
            $resume = new Resume();
            $resume->ownerEmail = $ownerEmail;
            $resume->userEmail = $userEmail;
            $resume->subject = $input['subject'];
            $resume->save();

            Resume::where("id","=", $resume->id)->update($shareData['shareData']);
        } else {
            $updateFlag = 1;
            $resume = Resume::where("ownerEmail","=",$ownerEmail)->where("userEmail","=",$userEmail)->get()->first();
            $resume->save();
            Resume::where("id","=", $resume->id)->update($shareData['shareData']);
        }


        $ownerData = User::where("email","=",$ownerEmail)->get()->first();
        $getUser = User::where("email","=",$userEmail)->get()->first();
        $activity['forUser'] = $ownerData['id'];
        $data['updateFlag'] = $updateFlag;
        $data['resumeId'] = $resume->id;
        $name = str_replace(" ", "-", Auth::user()->first_name."-".Auth::user()->last_name);
        $message = $input['message'];

        $passCode = $ownerData->resume_passcode;
        $url = $name."-".$data['resumeId']."/".$passCode;
        $message .=  "<br/>Click <a heref='".URL::to('wm').'/'.$url."'>here</a> to view resume or <br> copy paste url " . URL::to('wm')."/".$url;
        if($getUser){
            $activity['toUser'] = $getUser->id;
            $data['error'] = "0";
            Email::shareResume($userEmail,$ownerData->name,$input['subject'],$updateFlag, $message);
        } else {
            $data['error'] = "0";
            Email::sendInvite($userEmail,$ownerData->name,$input['subject'],$updateFlag, $message);
        }
        Resume::where("id","=", $resume->id)->update(['resume_url'=>$url]);
        $activity['byUser'] = Auth::id();
        $activity['email'] = $userEmail;
        $activity['activity'] = "resume_forwarded";
        $activity['request_status'] = "accepted";
        $activity['resume_id'] = $resume->id;
        $activity['created_at'] = date('Y-m-d H:i:s');
        // sent activity
        Activity::createActivity($activity);
        $request->session()->flash('success', 'Request has been sent successfully!');
        return response()->json($data);
    }

}
