<?php

namespace App\Http\Controllers\Resume;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Requests;
use Auth,View;
use App\User;
use DateTime;

use App\Model\Resumetitle;
use App\Model\Contact;
use App\Model\Objective;
use App\Model\Address;
use App\Model\Education;
use App\Model\Project;
use App\Model\SkillList;
use App\Model\Skill;
use App\Model\Softskills;
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
use App\Model\InterestsList;
use App\Model\Interests;
use App\Model\work_categories;
use App\Model\UserBasicInformations;


class UpdateController extends Controller
{

    public function __construct(Request $request){
        //its just a dummy data object.
        $dd = ['01','02','03','04','05','06','07','08','09','10','11','12','13','14','15','16','17','18','19','20','21','22','23','24','25','26','27','28','29','30','31'];
        $mm = ['01','02','03','04','05','06','07','08','09','10','11','12'];

        $minYYYY = 1970;
        $maxYYYY = date('Y');

        // Sharing is caring
        View::share('minYYYY', $minYYYY);
        View::share('maxYYYY', $maxYYYY);
        View::share('dd', $dd);
        View::share('mm', $mm);

        if(isset($request->redirectBack)){
            View::share('redirectBack', $request->redirectBack);
        }
    }

	public function index(Request $request){
        $input = $request->all();
        if(isset($input['sectionid'])){
            $data['sectionid'] = $input['sectionid'];
        }


        $user_id = Auth::id();

        $data['resumetitleInfo'] = Resumetitle::where("user_id","=",$user_id)->get()->first();
        $data['resumetitleCount'] = Resumetitle::where("user_id","=",$user_id)->count();

        $data['basicInfo'] = UserBasicInformations::where("user_id","=",$user_id)->get()->first();
        $data['basicInfoCount'] = UserBasicInformations::where("user_id","=",$user_id)->count();

        $data['profileImageData'] = User::select("avatar","avatar_updated","profilePrivate")->where("id","=",$user_id)->get()->first();

        $data['contactInfo'] = Contact::where("user_id","=",$user_id)->get()->first();
        $data['contactCount'] = Contact::where("user_id","=",$user_id)->count();

        $data['interestInfo'] = Interests::where("user_id","=",$user_id)->get()->first();
        $data['interestCount'] = Interests::where("user_id","=",$user_id)->count();

        $data['objectiveInfo'] = Objective::where("user_id","=",$user_id)->get()->first();
        $data['objectiveCount'] = Objective::where("user_id","=",$user_id)->count();

        $data['currentAddressInfo'] = Address::where("user_id","=", Auth::id())->where("type","0")->get()->first();
        $data['currentAddressCount'] = Address::where("user_id","=", Auth::id())->where("type","0")->count();

        $data['permanentAddressInfo'] = Address::where("user_id","=", Auth::id())->where("type","1")->get()->first();
        $data['permanentAddressCount'] = Address::where("user_id","=", Auth::id())->where("type","1")->count();

        $data['workInfo']  = Work::where("user_id","=", Auth::id())->get();
        $data['workCount'] = Work::where("user_id","=", Auth::id())->count();

        $data['educationInfo'] = Education::where("user_id","=", Auth::id())->get();
        $data['educationCount'] = Education::where("user_id","=", Auth::id())->count();

        $data['projectInfo'] = Project::where("user_id","=", Auth::id())->get();
        $data['projectCount'] = Project::where("user_id","=", Auth::id())->count();

        $data['skillInfo'] = Skill::where("user_id","=", Auth::id())->get();
        $data['skillCount'] = Skill::where("user_id","=", Auth::id())->count();

        $data['softskillInfo'] = Softskills::where("user_id","=", Auth::id())->get();
        $data['softskillCount'] = Softskills::where("user_id","=", Auth::id())->count();

        $data['interestsInfo'] = Interests::where("user_id","=", Auth::id())->get();
        $data['interestsCount'] = Interests::where("user_id","=", Auth::id())->count();

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

        $ownerEmail = Auth::user()->email;
        $data["resumeAccess"]  = Resume::where("ownerEmail","=",$ownerEmail)->get()->first();

        return view('update.index',$data);
    }
    // +++++++++++++++++++++++++++++++++ Resume Title Section ++++++++++++++++++++++++++++++
    public function resumeTitle(Request $request) {
        $data['return_url'] = ($request->query('url')) ? $request->query('url') : 'update?sectionid=resumetitleInfo';
        $data['resume_title'] = Resumetitle::where("user_id","=", Auth::id())->get()->first();
        return view('update.resume.resumetitle-form',$data);
    }

    public function getResumeTitleDetails(){
    	$data['resumetitle'] = Resumetitle::where("user_id","=", Auth::id())->get()->first();
    	if($data['resumetitle'] == ""){
    		$data['error'] = true;
    	} else{
            $data['error'] = false;
        }
    	return response()->json($data);
    }

    public function resumeTitleSave(Request $request){
    	$input = $request->all();
    	if($input['id'] == 0){
            $resumetitle = new Resumetitle();
        } else{
           $resumetitle = Resumetitle::find($input['id']);
        }
    	$resumetitle->user_id = Auth::id();
    	$resumetitle->resume_title = $input['resume_title'];
        $resumetitle->resume_brand = $input['resume_brand'];
        $resumetitle->resume_message = $input['resume_message'];
        $resumetitle->thanks_note = $input['thanks_note'];
    	$resumetitle->save();
        return redirect()->back();//->with('success', 'Resume Title details updated successfully.');
    }

    public function resumeTitleRemove($id){
        $resumetitle = Resumetitle::find($id);
        $data['error'] = "1";
        if(isset($resumetitle->user_id)){
            if($resumetitle->user_id == Auth::id()){
                $data['error'] = "0";
                $resumetitle->delete();
            }
        }
        return response()->json($data);
    }

    // +++++++++++++++++++++++++++++++++++++ Contact Section ++++++++++++++++++++++++++++++++++//

    public function contact(){

        $data["primaryEmail"] = Auth::user()->email;
        $data['countryNameList'] = ["Afghanistan","Albania","Algeria","American Samoa","Andorra","Angola","Anguilla","Antarctica","Antigua and Barbuda","Argentina","Armenia","Aruba","Australia","Austria","Azerbaijan","Bahamas","Bahrain","Bangladesh","Barbados","Belarus","Belgium","Belize","Benin","Bermuda","Bhutan","Bolivia","Bosnia and Herzegovina","Botswana","Brazil","British Indian Ocean Territory","British Virgin Islands","Brunei","Bulgaria","Burkina Faso","Burundi","Cambodia","Cameroon","Canada","Cape Verde","Cayman Islands","Central African Republic","Chad","Chile","China","Christmas Island","Cocos Islands","Colombia","Comoros","Cook Islands","Costa Rica","Croatia","Cuba","Curacao","Cyprus","Czech Republic","Democratic Republic of the Congo","Denmark","Djibouti","Dominica","Dominican Republic","East Timor","Ecuador","Egypt","El Salvador","Equatorial Guinea","Eritrea","Estonia","Ethiopia","Falkland Islands","Faroe Islands","Fiji","Finland","France","French Polynesia","Gabon","Gambia","Georgia","Germany","Ghana","Gibraltar","Greece","Greenland","Grenada","Guam","Guatemala","Guernsey","Guinea","Guinea-Bissau","Guyana","Haiti","Honduras","Hong Kong","Hungary","Iceland","India","Indonesia","Iran","Iraq","Ireland","Isle of Man","Israel","Italy","Ivory Coast","Jamaica","Japan","Jersey","Jordan","Kazakhstan","Kenya","Kiribati","Kosovo","Kuwait","Kyrgyzstan","Laos","Latvia","Lebanon","Lesotho","Liberia","Libya","Liechtenstein","Lithuania","Luxembourg","Macau","Macedonia","Madagascar","Malawi","Malaysia","Maldives","Mali","Malta","Marshall Islands","Mauritania","Mauritius","Mayotte","Mexico","Micronesia","Moldova","Monaco","Mongolia","Montenegro","Montserrat","Morocco","Mozambique","Myanmar","Namibia","Nauru","Nepal","Netherlands","Netherlands Antilles","New Caledonia","New Zealand","Nicaragua","Niger","Nigeria","Niue","North Korea","Northern Mariana Islands","Norway","Oman","Pakistan","Palau","Palestine","Panama","Papua New Guinea","Paraguay","Peru","Philippines","Pitcairn","Poland","Portugal","Puerto Rico","Qatar","Republic of the Congo","Reunion","Romania","Russia","Rwanda","Saint Barthelemy","Saint Helena","Saint Kitts and Nevis","Saint Lucia","Saint Martin","Saint Pierre and Miquelon","Saint Vincent and the Grenadines","Samoa","San Marino","Sao Tome and Principe","Saudi Arabia","Senegal","Serbia","Seychelles","Sierra Leone","Singapore","Sint Maarten","Slovakia","Slovenia","Solomon Islands","Somalia","South Africa","South Korea","South Sudan","Spain","Sri Lanka","Sudan","Suriname","Svalbard and Jan Mayen","Swaziland","Sweden","Switzerland","Syria","Taiwan","Tajikistan","Tanzania","Thailand","Togo","Tokelau","Tonga","Trinidad and Tobago","Tunisia","Turkey","Turkmenistan","Turks and Caicos Islands","Tuvalu","U.S. Virgin Islands","Uganda","Ukraine","United Arab Emirates","United Kingdom","United States","Uruguay","Uzbekistan","Vanuatu","Vatican","Venezuela","Vietnam","Wallis and Futuna","Western Sahara","Yemen","Zambia","Zimbabwe"];
    	$data['countryCodeList'] = ["93","355","213","1-684","376","244","1-264","672","1-268","54","374","297","61","43","994","1-242","973","880","1-246","375","32","501","229","1-441","975","591","387","267","55","246","1-284","673","359","226","257","855","237","1","238","1-345","236","235","56","86","61","61","57","269","682","506","385","53","599","357","420","243","45","253","1-767","1-809, 1-829, 1-849","670","593","20","503","240","291","372","251","500","298","679","358","33","689","241","220","995","49","233","350","30","299","1-473","1-671","502","44-1481","224","245","592","509","504","852","36","354","91","62","98","964","353","44-1624","972","39","225","1-876","81","44-1534","962","7","254","686","383","965","996","856","371","961","266","231","218","423","370","352","853","389","261","265","60","960","223","356","692","222","230","262","52","691","373","377","976","382","1-664","212","258","95","264","674","977","31","599","687","64","505","227","234","683","850","1-670","47","968","92","680","970","507","675","595","51","63","64","48","351","1-787, 1-939","974","242","262","40","7","250","590","290","1-869","1-758","590","508","1-784","685","378","239","966","221","381","248","232","65","1-721","421","386","677","252","27","82","211","34","94","249","597","47","268","46","41","963","886","992","255","66","228","690","676","1-868","216","90","993","1-649","688","1-340","256","380","971","44","1","598","998","678","379","58","84","681","212","967","260","263"];
    	$data['relationList'] = ["Self", "Husband", "Wife", "Friend", "Relative", "Father", "Mother", "Brother", "Sister", "Others"];
    	//print_r($data);
        $data['contact'] = Contact::where("user_id","=", Auth::id())->get()->first();
        return view('update.contact.contact-form', $data);
    }

    public function getContactDetails(){
    	$data['contact'] = Contact::where("user_id","=", Auth::id())->get()->first();
    	if($data['contact'] == ""){
    		$data['error'] = true;
    	} else{
            $data['error'] = false;
        }
    	return response()->json($data);
    }

    public function contactSave(Request $request){
    	$input = $request->all();
    	if($input['id'] == 0){
            $contact = new Contact();
        } else{
           $contact = Contact::find($input['id']);
        }
    	$contact->user_id = Auth::id();
    	$contact->primaryEmail = $input['primaryEmail'];
    	$contact->altEmail = $input['altEmail'];
    	$contact->primaryPhoneCode = $input['primaryPhoneCode'];
        $contact->primaryPhone = $input['primaryPhone'];
        $contact->url = $input['url'];
    	$contact->altPhoneCode = isset($input['altPhoneCode'])?$input['altPhoneCode']:"";
    	$contact->altPhone = $input['altPhone'];
    	$contact->altRelation = isset($input['altRelation'])?$input['altRelation']:"";
        $contact->save();
        return redirect()->back();//->with('success', 'Contact details updated successfully.');
    }

    public function contactRemove($id){
        $contact = Contact::find($id);
        $data['error'] = "1";
        if(isset($contact->user_id)){
            if($contact->user_id == Auth::id()){
                $data['error'] = "0";
                $contact->delete();
            }
        }
        return response()->json($data);
    }

    // ------------------------- Professional Summary --------------------------------

    public function objective(Request $request){
        $data['objective'] = Objective::where("user_id","=", Auth::id())->get()->first();
        $data['returnUrl'] = ($request->query('url')) ? $request->query('url') : 'update?sectionid=objectiveInfo';
        return view('update.objective.objective-form',$data);
    }

    public function getObjectiveDetails(){
        $data['objective'] = Objective::where("user_id","=", Auth::id())->get()->first();
        if(!is_object($data['objective'])){
            $data['error'] = true;
        } else{
            $data['error'] = false;
        }
        return response()->json($data);
    }

    public function objectiveSave(Request $request){
        $input = $request->all();
        if($input['id'] == 0){
            $objective = new Objective();
        } else{
           $objective = Objective::find($input['id']);
        }
        $objective->user_id = Auth::id();
        $objective->objective = $input['objective'];
        $objective->save();
        return redirect()->back();//->with('success', 'Objective updated successfully.');
    }

    public function objectiveRemove($id){
        $objective = Objective::find($id);
        $data['error'] = "1";
        if(isset($objective->user_id)){
            if($objective->user_id == Auth::id()){
                $data['error'] = "0";
                $objective->delete();
            }
        }
        return response()->json($data);
    }
    // +++++++++++++++++++++++++++++++ Current Address +++++++++++++++++++++++++++
    public function currentAddress(){
        $data['currentAddress'] = Address::where("user_id","=", Auth::id())->where("type","0")->get()->first();
        return view('update.address.current-address-form',$data);
    }

    public function getCurrentAddressDetails(){
        $data['currentAddress'] = Address::where("user_id","=", Auth::id())->where("type","0")->get()->first();
        if(sizeof($data['currentAddress']) <= 0){
            $data['error'] = true;
        } else{
            $data['error'] = false;
        }
        return response()->json($data);
    }

    public function currentAddressSave(Request $request){
        $input = $request->all();
        if($input['id'] == 0){
            $currentAddress = new Address();
        } else{
           $currentAddress = Address::find($input['id']);
        }
        $currentAddress->user_id = Auth::id();
        $currentAddress->type = "0";
        $currentAddress->houseNumber  = $input['houseNumber'];
        $currentAddress->blockSector  = $input['blockSector'];
        $currentAddress->societyName  = $input['societyName'];
        $currentAddress->landmark     = $input['landmark'];
        $currentAddress->area         = $input['area'];
        $currentAddress->pincode      = $input['pincode'];
        $currentAddress->city         = $input['city'];
        $currentAddress->country      = $input['country'];
        $currentAddress->save();
        return redirect()->back();//->with('success', 'Current Address updated successfully.');

    }

    public function currentAddressRemove($id){
        $currentAddress = Address::find($id);
        $data['error'] = "1";
        if(isset($currentAddress->user_id)){
            if($currentAddress->user_id == Auth::id()){
                $data['error'] = "0";
                $currentAddress->delete();
            }
        }
        return response()->json($data);
    }
// +++++++++++++++++++++++++++++++ Permanent Address +++++++++++++++++++++++++++
    public function permanentAddress(){
        $data['permanentAddress'] = Address::where("user_id","=", Auth::id())->where("type","1")->get()->first();
        return view('update.address.permanent-address-form',$data);
    }

    public function getPermanentAddressDetails(){
        $data['permanentAddress'] = Address::where("user_id","=", Auth::id())->where("type","1")->get()->first();
        if(sizeof($data['permanentAddress']) <= 0){
            $data['error'] = true;
        } else{
            $data['error'] = false;
        }
        return response()->json($data);
    }

    public function permanentAddressSave(Request $request){
        $input = $request->all();
        if($input['id'] == 0){
            $permanentAddress = new Address();
        } else{
           $permanentAddress = Address::find($input['id']);
        }
        $permanentAddress->user_id = Auth::id();
        $permanentAddress->type = "1";
        $permanentAddress->houseNumber  = $input['houseNumber'];
        $permanentAddress->blockSector  = $input['blockSector'];
        $permanentAddress->societyName  = $input['societyName'];
        $permanentAddress->landmark     = $input['landmark'];
        $permanentAddress->area         = $input['area'];
        $permanentAddress->pincode      = $input['pincode'];
        $permanentAddress->city         = $input['city'];
        $permanentAddress->country      = $input['country'];
        $permanentAddress->save();
        return redirect()->back();//->with('success', 'Permanent address updated successfully.');

    }

    public function permanentAddressRemove($id){
        $permanentAddress = Address::find($id);
        $data['error'] = "1";
        if(isset($permanentAddress->user_id)){
            if($permanentAddress->user_id == Auth::id()){
                $data['error'] = "0";
                $permanentAddress->delete();
            }
        }
        return response()->json($data);
    }

// +++++++++++++++++++++++++++++++ Education Section +++++++++++++++++++++++++++
    public function education($id=0, Request $request){
        $data['id'] = $id;
        $data['returnUrl'] = ($request->query('url')) ? $request->query('url') : 'update?sectionid=educationInfo';
        $data['education'] = Education::where("user_id","=", Auth::id())->where("id",$id)->get()->first();
        return view('update.education.education-form',$data);
    }

    public function getEducationDetails(Request $request){        $input = $request->all();

        $data['education'] = Education::where("user_id","=", Auth::id())->where("id",$input['id'])->get()->first();
        $data['educationCount'] = Education::where("user_id","=", Auth::id())->where("id",$input['id'])->count();
        if($data['educationCount'] <= 0){
            $data['error'] = true;
        } else{
            $data['error'] = false;
        }
        return response()->json($data);
    }

    public function educationSave(Request $request){
        $input = $request->all();
        if($input['id'] == 0){
            $education = new Education();
        } else{
           $education = Education::find($input['id']);
        }
        $education->user_id = Auth::id();


        $education->education       = $input['education'];
        $education->school          = $input['school'];
        $education->city            = $input['city'];
        $education->country         = $input['country'];
        $education->educationName   = $input['educationName'];
        $education->branch          = $input['branch'];
        $education->dd              = isset($input['dd'])?$input['dd']:"";
        $education->mm              = isset($input['mm'])?$input['mm']:"";
        $education->yyyy            = isset($input['yyyy'])?$input['yyyy']:"";
        if(isset($input['dd'])){
            $education->educationDate   = $this->createDate($input['dd'],$input['mm'],$input['yyyy']);
        }
        $education->grade           = isset($input['grade'])?$input['grade']:"";
        $education->gradeValue      = $input['gradeValue'];

        $education->best                 =isset($input['best'])?$input['best']:"0";
        $education->save();
        $returnUrl = ($input['returnUrl']) ? $input['returnUrl'] : 'update?sectionid=educationInfo';
        return redirect('/'.$returnUrl);//->with('success', 'Education details updated successfully.');
    }


    public function educationRemove($id){
        $education = Education::find($id);
        $data['error'] = "1";
        if(isset($education->user_id)){
            if($education->user_id == Auth::id()){
                $data['error'] = "0";
                $education->delete();
            }
        }
        return response()->json($data);
    }

// +++++++++++++++++++++++++++++++ Project Section +++++++++++++++++++++++++++
    public function project($id=0){
        $data['id'] = $id;
        $data['project'] = Project::where("user_id","=", Auth::id())->where("id",$id)->get()->first();
        return view('update.project.project-form',$data);
    }

    public function getProjectDetails(Request $request){
        $input = $request->all();
        $data['project'] = Project::where("user_id","=", Auth::id())->where("id",$input['id'])->get()->first();
        $data['projectCount'] = Project::where("user_id","=", Auth::id())->where("id",$input['id'])->count();
        if($data['projectCount'] <= 0){
            $data['error'] = true;
        } else{
            $data['error'] = false;
        }
        return response()->json($data);
    }

    public function projectSave(Request $request){
        $input = $request->all();
        if($input['id'] == 0){
            $project = new Project();
        } else{
           $project = Project::find($input['id']);
        }
        $project->user_id = Auth::id();


        $project->project           = $input['project'];
        $project->school            = $input['school'];
        $project->projectDesc       = $input['projectDesc'];
        $project->url               = $input['url'];
        $project->dd                = isset($input['dd'])?$input['dd']:"";
        $project->mm                = isset($input['mm'])?$input['mm']:"";
        $project->yyyy              = isset($input['yyyy'])?$input['yyyy']:"";
        if(isset($input['dd'])){
            $project->projectDate   = $this->createDate($input['dd'],$input['mm'],$input['yyyy']);
        }
        $project->city              = $input['city'];
        $project->country           = $input['country'];

        $project->best              = isset($input['best'])?$input['best']:"0";
        $project->save();
        return redirect('/update');//->with('success', 'Projects details updated successfully.');
    }

    public function projectRemove($id){
        $project = Project::find($id);
        $data['error'] = "1";
        if(isset($project->user_id)){
            if($project->user_id == Auth::id()){
                $data['error'] = "0";
                $project->delete();
            }
        }
        return response()->json($data);
    }

// +++++++++++++++++++++++++++++++ Skills Section +++++++++++++++++++++++++++
    public function skill($id=0){
        $data['id'] = $id;
        $restult = SkillList::where('skill_type','functional')->get()->toArray();

        $skillList = array();

        foreach ($restult as $key => $value) {
            $skillList[$key] = $value['name'];
        }

        $data['skillList'] = $skillList;
        return view('update.skill.skill-form',$data);
    }

    public function getSkillDetails(Request $request){
        $input = $request->all();
        $data['skill'] = Skill::where("user_id","=", Auth::id())->get()->first();
        $data['skillCount'] = Skill::where("user_id","=", Auth::id())->count();
        if($data['skillCount'] <= 0){
            $data['error'] = true;
        } else{
            $data['error'] = false;
        }
        return response()->json($data);
    }

    public function skillSave(Request $request){
        $input = $request->all();

        $skills = json_encode($input['skills']);

        if($input['id'] == 0){
            $skill = new Skill();
        } else{
           $skill = Skill::find($input['id']);
        }
        $skill->user_id = Auth::id();
        $skill->skill = $skills;
        $skill->save();

    }

    public function skillRemove($id){
        $skill = Skill::find($id);
        $data['error'] = "1";
        if(isset($skill->user_id)){
            if($skill->user_id == Auth::id()){
                $data['error'] = "0";
                $skill->delete();
            }
        }
        return response()->json($data);
    }


    public function updateNewSkill(Request $request){
        $input = $request->all();
        //echo $input["name"];

        $newSkill = new SkillList();
        $newSkill->head = $input["name"];
        $newSkill->name = $input["name"];
        $newSkill->save();
    }

    /* soft skills */
    public function softskill($id=0, Request $request){
        $data['id'] = $id;
        $restult = SkillList::where('skill_type','soft')->get()->toArray();
        $skillList = array();
        foreach ($restult as $key => $value) {
            $skillList[$key] = $value['name'];
        }
        $data['returnUrl'] = ($request->query('url')) ? $request->query('url') : "update?sectionid=softskillInfo";
        $data['skillList'] = $skillList;
        return view('update.skill.skill_soft-form',$data);
    }

    public function getSoftSkillDetails(Request $request){
        $input = $request->all();
        $data['softSkill'] = Softskills::where("user_id","=", Auth::id())->get()->first();
        $data['softSkillCount'] = Softskills::where("user_id","=", Auth::id())->count();
        if($data['softSkillCount'] <= 0){
            $data['error'] = true;
        } else{
            $data['error'] = false;
        }
        return response()->json($data);
    }

    public function softSkillSave(Request $request){
        $input = $request->all();

        $skills = json_encode($input['skills']);

        if($input['id'] == 0){
            $skill = new Softskills();
        } else{
           $skill = Softskills::find($input['id']);
        }
        $skill->user_id = Auth::id();
        $skill->soft_skill  = $skills;
        $skill->save();

    }

    public function softSkillRemove($id){
        $skill = Softskills::find($id);
        $data['error'] = "1";
        if(isset($skill->user_id)){
            if($skill->user_id == Auth::id()){
                $data['error'] = "0";
                $skill->delete();
            }
        }
        return response()->json($data);
    }
    /* end soft skills */

     /* interests */

     public function interests($id=0){
        $data['id'] = $id;
        $restult = InterestsList::get()->toArray();

        $interestsList = array();

        foreach ($restult as $key => $value) {
            $interestsList[$key] = $value['name'];
        }

        $data['interestsList'] = $interestsList;
        return view('update.interests.interests-form',$data);
    }

    public function getInterestsDetails(Request $request){
        $input = $request->all();
        $data['interests'] = Interests::where("user_id","=", Auth::id())->get()->first();
        $data['interestsCount'] = Interests::where("user_id","=", Auth::id())->count();
        if($data['interestsCount'] <= 0){
            $data['error'] = true;
        } else{
            $data['error'] = false;
        }
        return response()->json($data);
    }

    public function interestsSave(Request $request){
        $input = $request->all();

        $skills = json_encode($input['interests']);

        if($input['id'] == 0){
            $skill = new Interests();
        } else{
           $skill = Interests::find($input['id']);
        }
        $skill->user_id = Auth::id();
        $skill->interest  = $skills;
        $skill->save();

    }

    public function interestsRemove($id){
        $skill = Interests::find($id);
        $data['error'] = "1";
        if(isset($skill->user_id)){
            if($skill->user_id == Auth::id()){
                $data['error'] = "0";
                $skill->delete();
            }
        }
        return response()->json($data);
    }

    /* end of intrests */

    public function certification($id=0, Request $request){
        $data['id'] = $id;
        $data['returnUrl'] = ($request->query('url')) ? $request->query('url') : "update?sectionid=certificationInfo";
        $data['certification'] = Certification::where("user_id","=", Auth::id())->where("id",$id)->get()->first();
        return view('update.certification.certification-form',$data);
    }

    public function getCertificationDetails(Request $request){
        $input = $request->all();
        $data['certification'] = Certification::where("user_id","=", Auth::id())->where("id",$input['id'])->get()->first();
        $data['certificationCount'] = Certification::where("user_id","=", Auth::id())->where("id",$input['id'])->count();
        if($data['certificationCount'] <= 0){
            $data['error'] = true;
        } else{
            $data['error'] = false;
        }
        return response()->json($data);
    }

    public function certificationSave(Request $request){
        $input = $request->all();
        if($input['id'] == 0){
            $certification = new Certification();
        } else{
           $certification = Certification::find($input['id']);
        }
        $certification->user_id = Auth::id();
        $certification->certification           = $input['certification'];
        $certification->school                  = $input['school'];
        $certification->dd                      = isset($input['dd'])?$input['dd']:"";
        $certification->mm                      = isset($input['mm'])?$input['mm']:"";
        $certification->yyyy                    = isset($input['yyyy'])?$input['yyyy']:"";

        if(isset($input['dd'])){
            $certification->certificationDate       = $this->createDate($input['dd'],$input['mm'],$input['yyyy']);
        }

        $certification->city                    = $input['city'];
        $certification->country                 = $input['country'];

        $certification->best              = isset($input['best'])?$input['best']:"0";
        $certification->save();
    }

    public function certificationRemove($id){
        $certification = Certification::find($id);
        $data['error'] = "1";
        if(isset($certification->user_id)){
            if($certification->user_id == Auth::id()){
                $data['error'] = "0";
                $certification->delete();
            }
        }
        return response()->json($data);
    }

    public function training($id=0, Request $request){
        $data['id'] = $id;
        $data['returnUrl'] = ($request->query('url')) ? $request->query('url') : "update?sectionid=trainingInfo";
        $data['training'] = Training::where("user_id","=", Auth::id())->where("id",$id)->get()->first();
        return view('update.training.training-form',$data);
    }

    public function getTrainingDetails(Request $request){
        $input = $request->all();
        $data['training'] = Training::where("user_id","=", Auth::id())->where("id",$input['id'])->get()->first();
        $data['trainingCount'] = Training::where("user_id","=", Auth::id())->where("id",$input['id'])->count();

        if($data['trainingCount'] <= 0){
            $data['error'] = true;
        } else{
            $data['error'] = false;
        }
        return response()->json($data);
    }

    public function trainingSave(Request $request){
        $input = $request->all();
        if($input['id'] == 0){
            $training = new Training();
        } else{
           $training = Training::find($input['id']);
        }
        $training->user_id = Auth::id();
        $training->training           = $input['training'];
        $training->school             = $input['school'];
        $training->dd                 = isset($input['dd'])?$input['dd']:"";
        $training->mm                 = isset($input['mm'])?$input['mm']:"";
        $training->yyyy               = isset($input['yyyy'])?$input['yyyy']:"";
        if(isset($input['dd'])){
            $training->trainingDate       = $this->createDate($input['dd'],$input['mm'],$input['yyyy']);
        }
        $training->city               = $input['city'];
        $training->country            = $input['country'];

        $training->best              = isset($input['best'])?$input['best']:"0";
        $training->save();
    }

    public function trainingRemove($id){
        $training = Training::find($id);
        $data['error'] = "1";
        if(isset($training->user_id)){
            if($training->user_id == Auth::id()){
                $data['error'] = "0";
                $training->delete();
            }
        }
        return response()->json($data);
    }

    public function course($id=0, Request $request){
        $data['id'] = $id;
        $data['returnUrl'] = ($request->query('url')) ? $request->query('url') : "update?sectionid=courseInfo";
        $data['course'] = Course::where("user_id","=", Auth::id())->where("id",$id)->get()->first();
        return view('update.course.course-form',$data);
    }

    public function getCourseDetails(Request $request){
        $input = $request->all();
        $data['course'] = Course::where("user_id","=", Auth::id())->where("id",$input['id'])->get()->first();
        $data['courseCount'] = Course::where("user_id","=", Auth::id())->where("id",$input['id'])->count();
        if($data['courseCount'] <= 0){
            $data['error'] = true;
        } else{
            $data['error'] = false;
        }
        return response()->json($data);
    }

    public function courseSave(Request $request){
        $input = $request->all();
        if($input['id'] == 0){
            $course = new Course();
        } else{
           $course = Course::find($input['id']);
        }
        $course->user_id = Auth::id();
        $course->course             = $input['course'];
        $course->school             = $input['school'];
        $course->dd                 = isset($input['dd'])?$input['dd']:"";
        $course->mm                 = isset($input['mm'])?$input['mm']:"";
        $course->yyyy               = isset($input['yyyy'])?$input['yyyy']:"";
        if(isset($input['dd'])){
            $course->courseDate         = $this->createDate($input['dd'],$input['mm'],$input['yyyy']);
        }
        $course->grade            = isset($input['grade'])?$input['grade']:"";;
        $course->gradeValue       = $input['gradeValue'];

        $course->best       = isset($input['best'])?$input['best']:"0";
        $course->save();
    }

    public function courseRemove($id){
        $course = Course::find($id);
        $data['error'] = "1";
        if(isset($course->user_id)){
            if($course->user_id == Auth::id()){
                $data['error'] = "0";
                $course->delete();
            }
        }
        return response()->json($data);
    }

    public function travel($id=0, Request $request){
        $data['id'] = $id;
        $data['work_categories'] = work_categories::orderBy('title')->get()->toArray();
        $data['travel'] = Travel::where("user_id","=", Auth::id())->where("id",$data['id'])->get()->first();
        $data['returnUrl'] = ($request->query('url')) ? $request->query('url') : "update?sectionid=travelInfo";
        return view('update.travel.travel-form',$data);
    }

    public function getTravelDetails(Request $request){
        $input = $request->all();
        $data['travel'] = Travel::where("user_id","=", Auth::id())->where("id",$input['id'])->get()->first();
        $data['travelCount'] = Travel::where("user_id","=", Auth::id())->where("id",$input['id'])->count();
        if($data['travelCount'] <= 0){
            $data['error'] = true;
        } else{
            $data['error'] = false;
        }
        return response()->json($data);
    }

    public function travelSave(Request $request){
        $input = $request->all();
        if($input['id'] == 0){
            $travel = new Travel();
        } else{
           $travel = Travel::find($input['id']);
        }
        $travel->user_id = Auth::id();
        $travel->work_category      = $input['work_category'];
        $travel->project            = $input['project'];
        $travel->projectDesc        = $input['projectDesc'];
        $travel->company            = $input['company'];
        $travel->url                = $input['url'];

        $travel->ddStart            = isset($input['ddStart'])?$input['ddStart']:"";
        $travel->mmStart            = isset($input['mmStart'])?$input['mmStart']:"";
        $travel->yyyyStart          = isset($input['yyyyStart'])?$input['yyyyStart']:"";

        if(isset($input['ddStart'])){
            $travel->projectStartDate   = $this->createDate($input['ddStart'],$input['mmStart'],$input['yyyyStart']);
        }
        $travel->ddEnd              = isset($input['ddEnd'])?$input['ddEnd']:"";
        $travel->mmEnd              = isset($input['mmEnd'])?$input['mmEnd']:"";
        $travel->yyyyEnd            = isset($input['yyyyEnd'])?$input['yyyyEnd']:"";

        if(isset($input['ddEnd'])){
            $travel->projectEndDate     = $this->createDate($input['ddEnd'],$input['mmEnd'],$input['yyyyEnd']);
        }

        $travel->city               = $input['city'];
        $travel->country            = $input['country'];

        $travel->best       = isset($input['best'])?$input['best']:"0";
        $travel->save();
    }

    public function travelRemove($id){
        $travel = Travel::find($id);
        $data['error'] = "1";
        if(isset($travel->user_id)){
            if($travel->user_id == Auth::id()){
                $data['error'] = "0";
                $travel->delete();
            }
        }
        return response()->json($data);
    }

    public function award($id=0, Request $request){
        $data['id'] = $id;
        $data['returnUrl'] = ($request->query('url')) ? $request->query('url') : "update?sectionid=awardInfo";
        $data['award'] = Award::where("user_id","=", Auth::id())->where("id",$id)->get()->first();
        return view('update.award.award-form',$data);
    }

    public function getAwardDetails(Request $request){
        $input = $request->all();
        $data['award'] = Award::where("user_id","=", Auth::id())->where("id",$input['id'])->get()->first();
        $data['awardCount'] = Award::where("user_id","=", Auth::id())->where("id",$input['id'])->count();
        if($data['awardCount'] <= 0){
            $data['error'] = true;
        } else{
            $data['error'] = false;
        }
        return response()->json($data);
    }

    public function awardSave(Request $request){
        $input = $request->all();
        if($input['id'] == 0){
            $award = new Award();
        } else{
           $award = Award::find($input['id']);
        }
        $award->user_id = Auth::id();
        $award->award           = $input['award'];
        $award->school             = $input['school'];
        $award->dd                 = isset($input['dd'])?$input['dd']:"";
        $award->mm                 = isset($input['mm'])?$input['mm']:"";
        $award->yyyy               = isset($input['yyyy'])?$input['yyyy']:"";
        if(isset($input['dd'])){
            $award->awardDate          = $this->createDate($input['dd'],$input['mm'],$input['yyyy']);
        }
        $award->city               = $input['city'];
        $award->country            = $input['country'];

        $award->best       = isset($input['best'])?$input['best']:"0";
        $award->save();
    }

    public function awardRemove($id){
        $award = Award::find($id);
        $data['error'] = "1";
        if(isset($award->user_id)){
            if($award->user_id == Auth::id()){
                $data['error'] = "0";
                $award->delete();
            }
        }
        return response()->json($data);
    }

    public function patent($id=0){
        $data['id'] = $id;
        $data['patent'] = Patent::where("user_id","=", Auth::id())->where("id",$id)->get()->first();
        return view('update.patent.patent-form',$data);
    }

    public function getPatentDetails(Request $request){
        $input = $request->all();
        $data['patent'] = Patent::where("user_id","=", Auth::id())->where("id",$input['id'])->get()->first();
        $data['patentCount'] = Patent::where("user_id","=", Auth::id())->where("id",$input['id'])->count();
        if($data['patentCount'] <= 0){
            $data['error'] = true;
        } else{
            $data['error'] = false;
        }
        return response()->json($data);
    }

    public function patentSave(Request $request){
        $input = $request->all();
        if($input['id'] == 0){
            $patent = new Patent();
        } else{
           $patent = Patent::find($input['id']);
        }
        $patent->user_id = Auth::id();
        $patent->patent             = $input['patent'];
        $patent->reference          = $input['reference'];
        $patent->status             = $input['status'];

        $patent->best       = isset($input['best'])?$input['best']:"0";
        $patent->save();
    }

    public function patentRemove($id){
        $patent = Patent::find($id);
        $data['error'] = "1";
        if(isset($patent->user_id)){
            if($patent->user_id == Auth::id()){
                $data['error'] = "0";
                $patent->delete();
            }
        }
        return response()->json($data);
    }

    public function language($id=0, Request $request){
        $data['id'] = $id;
        $data['language'] = Language::where("user_id","=", Auth::id())->where("id",$id)->get()->first();
        $data['returnUrl'] = ($request->query('url')) ? $request->query('url') : "update?sectionid=languageInfo";
        return view('update.language.language-form',$data);
    }

    public function getLanguageDetails(Request $request){
        $input = $request->all();
        $data['language'] = Language::where("user_id","=", Auth::id())->where("id",$input['id'])->get()->first();
        $data['languageCount'] = Language::where("user_id","=", Auth::id())->where("id",$input['id'])->count();
        if($data['languageCount'] <= 0){
            $data['error'] = true;
        } else{
            $data['error'] = false;
        }
        return response()->json($data);
    }

    public function languageSave(Request $request){
        $input = $request->all();
        if($input['id'] == 0){
            $language = new Language();
        } else{
           $language = Language::find($input['id']);
        }
        $language->user_id = Auth::id();
        $language->language      = $input['language'];
        $language->read          = isset($input['read'])?$input['read']:"0";
        $language->write         = isset($input['write'])?$input['write']:"0";
        $language->speak         = isset($input['speak'])?$input['speak']:"0";
        $language->save();
    }

    public function languageRemove($id){
        $language = Language::find($id);
        $data['error'] = "1";
        if(isset($language->user_id)){
            if($language->user_id == Auth::id()){
                $data['error'] = "0";
                $language->delete();
            }
        }
        return response()->json($data);
    }

    public function reference($id=0, Request $request){
        $data['id'] = $id;
        $data['reference'] = Reference::where("user_id","=", Auth::id())->where("id",$id)->get()->first();
        $data['countryCodeList'] = ["93","355","213","1-684","376","244","1-264","672","1-268","54","374","297","61","43","994","1-242","973","880","1-246","375","32","501","229","1-441","975","591","387","267","55","246","1-284","673","359","226","257","855","237","1","238","1-345","236","235","56","86","61","61","57","269","682","506","385","53","599","357","420","243","45","253","1-767","1-809, 1-829, 1-849","670","593","20","503","240","291","372","251","500","298","679","358","33","689","241","220","995","49","233","350","30","299","1-473","1-671","502","44-1481","224","245","592","509","504","852","36","354","91","62","98","964","353","44-1624","972","39","225","1-876","81","44-1534","962","7","254","686","383","965","996","856","371","961","266","231","218","423","370","352","853","389","261","265","60","960","223","356","692","222","230","262","52","691","373","377","976","382","1-664","212","258","95","264","674","977","31","599","687","64","505","227","234","683","850","1-670","47","968","92","680","970","507","675","595","51","63","64","48","351","1-787, 1-939","974","242","262","40","7","250","590","290","1-869","1-758","590","508","1-784","685","378","239","966","221","381","248","232","65","1-721","421","386","677","252","27","82","211","34","94","249","597","47","268","46","41","963","886","992","255","66","228","690","676","1-868","216","90","993","1-649","688","1-340","256","380","971","44","1","598","998","678","379","58","84","681","212","967","260","263"];
        $data['returnUrl'] = ($request->query('url')) ? $request->query('url') : "update?sectionid=softskillInfo";
        return view('update.reference.reference-form',$data);
    }

    public function getReferenceDetails(Request $request){
        $input = $request->all();
        $data['reference'] = Reference::where("user_id","=", Auth::id())->where("id",$input['id'])->get()->first();
        $data['referenceCount'] = Reference::where("user_id","=", Auth::id())->where("id",$input['id'])->count();
        if($data['referenceCount'] <= 0){
            $data['error'] = true;
        } else{
            $data['error'] = false;
        }
        return response()->json($data);
    }

    public function referenceSave(Request $request){
        $input = $request->all();
        if($input['id'] == 0){
            $reference = new Reference();
        } else{
           $reference = Reference::find($input['id']);
        }
        $reference->user_id         = Auth::id();
        $reference->reference      = $input['reference'];
        $reference->school          = $input['school'];
        $reference->role         = $input['role'];
        $reference->remarks         = $input['remarks'];
        $reference->phone         = $input['phone'];
        $reference->email         = $input['email'];
        $reference->phoneCode         = $input['phoneCode'];

        $reference->save();
    }

    public function referenceRemove($id){
        $reference = Reference::find($id);
        $data['error'] = "1";
        if(isset($reference->user_id)){
            if($reference->user_id == Auth::id()){
                $data['error'] = "0";
                $reference->delete();
            }
        }
        return response()->json($data);
    }


    public function work($id=0, Request $request){

        if($id!=0){
            $data['work'] = Work::where("user_id","=", Auth::id())->where("id",$id)->get()->first();
        }else{
            $data['work'] = array();
        }
        $data['returnUrl'] = ($request->query('url')) ? $request->query('url'): 'update?sectionid=workInfo';
        $data['returnUrl'] = url('/'. $data['returnUrl'] );
        $data['id'] = $id;
        return view('update.work.work-form',$data);
    }

    public function getWorkDetails(Request $request){
        $input = $request->all();
        $data['work'] = Work::where("user_id","=", Auth::id())->where("id",$input['id'])->get()->first();
        $data['workCount'] = Work::where("user_id","=", Auth::id())->where("id",$input['id'])->count();
        if($data['workCount'] <= 0){
            $data['error'] = true;
        } else{
            $data['error'] = false;
        }
        return response()->json($data);
    }

    public function workSave(Request $request){
        $input = $request->all();
        if($input['id'] == 0){
            $work = new Work();
        } else{
           $work = Work::find($input['id']);
        }
        $data['returnUrl'] = ($input['returnUrl']) ? $input['returnUrl'] : 'update?sectionid=workInfo';

        $work->user_id = Auth::id();
        $work->company              =$input['company'];
        $work->employementType      =$input['employementType'];
        $work->employementStatus    =$input['employementStatus'];
        $work->city                 =$input['city'];
        $work->country              =$input['country'];
        $work->level                =$input['level'];
        $work->designation          =$input['designation'];
        $work->department           =$input['department'];
        $work->role                 =$input['role'];
        $work->roleDesc             =$input['roleDesc'];
        $work->teamSize             =$input['teamSize'];
        $work->ddStart              = isset($input['ddStart'])?$input['ddStart']:"01";
        $work->mmStart              = isset($input['mmStart'])?$input['mmStart']:"01";
        $work->yyyyStart            = isset($input['yyyyStart'])?$input['yyyyStart']:"";

        if(isset($input['ddStart']) && $input['ddStart'] !="" ){
            $work->workStartDate        = $this->createDate($input['ddStart'],$input['mmStart'],$input['yyyyStart']);
        } else{
            $work->workStartDate        = $this->createDate("01",$input['mmStart'],$input['yyyyStart']);
        }
        if(isset($input['yyyyEnd']) && isset($input['mmEnd'])) {
            $work->ddEnd                = isset($input['ddEnd'])?$input['ddEnd']:"01";
            $work->mmEnd                = isset($input['mmEnd'])?$input['mmEnd']:"";
            $work->yyyyEnd              = isset($input['yyyyEnd'])?$input['yyyyEnd']:"";
            $work->workEndDate          = $this->createDate("01",$input['mmEnd'],$input['yyyyEnd']);
        } else {
            $work->ddEnd                = "";
            $work->mmEnd                = "";
            $work->yyyyEnd              = "";
            $work->workEndDate          = '0000-00-00 00:00:00';
        }


        $work->fixCurrency          =isset($input['fixCurrency'])?$input['fixCurrency']:"";
        $work->fixSalaryType        =isset($input['fixSalaryType'])?$input['fixSalaryType']:"";
        $work->fixSalary            =$input['fixSalary'];
        //$work->variableCurrency     =$input['variableCurrency'];
        $work->variableSalaryType   =isset($input['variableSalaryType'])?$input['variableSalaryType']:"";
        $work->variableSalary       =$input['variableSalary'];
        $work->ctc                  =$input['ctc'];
        $work->best                 =isset($input['best'])?$input['best']:"0";
        $work->save();
        return redirect($data['returnUrl']);//->with('success', 'Work details updated successfully.');
    }


    public function workRemove($id){
        $work = Work::find($id);
        $data['error'] = "1";
        if(isset($work->user_id)){
            if($work->user_id == Auth::id()){
                $data['error'] = "0";
                $work->delete();
            }
        }
        return response()->json($data);
    }



    public function createDate($dd="17",$mm="07",$yyyy="2017"){
        $date = "$dd-$mm-$yyyy";
        //echo $date; echo "<br>";
        $mySqlDate = date('Y-m-d', strtotime($date));
        //echo $mySqlDate; echo "<br>";
        $month =  date("M",strtotime($mySqlDate));
        //echo $month;
        return $mySqlDate;
    }


    public function dateDiffrence($date1,$date2){


        $interval = $date2->diff($date1);
        return $interval->format('%Y years, %m months, %d days');

    }

    public function PPCheck(Request $request){
        $input = $request->all();
        $user_id = Auth::id();
        $value="0";
        if($input['value']=="true"){
            $value="1";
        }
        //echo $value;
        switch ($input['section']) {
            case 'profilePrivate':
                User::where("id","=",$user_id)->update(['profilePrivate' => $value]);
                break;

            case 'basic_info':
                UserBasicInformations::where("user_id","=",$user_id)->update(['private' => $value]);
            break;

            case 'contact':
                Contact::where("user_id","=",$user_id)->update(['private' => $value]);
            break;

            case 'resumetitle':
                Resumetitle::where("user_id","=",$user_id)->update(['private' => $value]);
                break;

            case 'objective':
                Objective::where("user_id","=",$user_id)->update(['private' => $value]);
                break;

            case 'currentAddress':
                Address::where("user_id","=",$user_id)->where("type","=","0")->update(['private' => $value]);
                break;

            case 'permanentAddress':
                Address::where("user_id","=",$user_id)->where("type","=","1")->update(['private' => $value]);
                break;

            case 'education':
                Education::where("user_id","=",$user_id)->where('id', "=", $input['id'])->update(['private' => $value]);
                break;

            case 'project':
                Project::where("user_id","=",$user_id)->where('id', "=", $input['id'])->update(['private' => $value]);
                break;

            case 'skill':
                Skill::where("user_id","=",$user_id)->update(['private' => $value]);
                break;

            case 'softskill':
                Skill::where("user_id","=",$user_id)->update(['private' => $value]);
                break;

            case 'certification':
                Certification::where("user_id","=",$user_id)->where('id', "=", $input['id'])->update(['private' => $value]);
                break;

            case 'training':
                Training::where("user_id","=",$user_id)->where('id', "=", $input['id'])->update(['private' => $value]);
                break;

            case 'course':
                Course::where("user_id","=",$user_id)->where('id', "=", $input['id'])->update(['private' => $value]);
                break;

            case 'travel':
                Travel::where("user_id","=",$user_id)->where('id', "=", $input['id'])->update(['private' => $value]);
                break;

            case 'award':
                Award::where("user_id","=",$user_id)->where('id', "=", $input['id'])->update(['private' => $value]);
                break;

            case 'patent':
                Patent::where("user_id","=",$user_id)->update(['private' => $value]);
                break;

            case 'language':
                Language::where("user_id","=",$user_id)->where('id', "=", $input['id'])->update(['private' => $value]);
                break;

            case 'reference':
                Reference::where("user_id","=",$user_id)->where('id', "=", $input['id'])->update(['private' => $value]);
                break;

            case 'work':
                Work::where("user_id","=",$user_id)->where('id', "=", $input['id'])->update(['private' => $value]);
                break;

            default:
                # code...
                break;
        }
    }
}
