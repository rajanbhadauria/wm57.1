<?php

namespace App\Model;
use DB;
use Illuminate\Database\Eloquent\Model;

class Resume extends Model
{
    //
    public static function getResumeCount($userId) {
       $sql = "SELECT count(*) as total FROM resume_stats WHERE resume_user_id = '".$userId."' AND  viewed_by != '".$userId."' GROUP BY viewed_by";
        $result = DB::select($sql);

        if(isset($result[0])) {
            return $result[0]->total;
        } else {
            return 0;
        }
    }
    //
    // checking if user is created resume or not
    public static function createAccessResume($ownerEmail, $userEmail) {
        $resume = self::where("ownerEmail","=",$ownerEmail)->whereNull("userEmail")->count();
        $user = DB::table('users')->where('email', $ownerEmail)->first();
        if($user) {
            $url = str_replace(" ", "-", $user->first_name."-".$user->last_name);
        } else {
            $url = "";
        }
        if($resume == 0) {
            $resume = new Resume();
            $resume->ownerEmail = $ownerEmail;
            $resume->userEmail = null;
            $resume->currentAddressData = '1'; $resume->awardData = '1'; $resume->certificationData = '1';
            $resume->permanentAddressData = '1'; $resume->contactData = '1'; $resume->courseData = '1';
            $resume->educationData = '1'; $resume->languageData = '1'; $resume->objectiveData = '1';
            $resume->patentData = '1'; $resume->profileData = '1'; $resume->projectData = '1';
            $resume->referenceData = '1'; $resume->skillData = '1'; $resume->trainingData = '1';
            $resume->travelData = '1'; $resume->workData = '1'; $resume->status = '1';
            $resume->resumetitleData = '1'; $resume->basicInfoData = '1'; $resume->softskillData = '1';
            $resume->interestData = '1'; $resume->is_visible = '1'; $resume->is_secure = '1';
            $resume->save();

            $resume = new Resume();
            $resume->ownerEmail = $ownerEmail;
            $resume->userEmail = $userEmail;
            $resume->currentAddressData = '1'; $resume->awardData = '1'; $resume->certificationData = '1';
            $resume->permanentAddressData = '1'; $resume->contactData = '1'; $resume->courseData = '1';
            $resume->educationData = '1'; $resume->languageData = '1'; $resume->objectiveData = '1';
            $resume->patentData = '1'; $resume->profileData = '1'; $resume->projectData = '1';
            $resume->referenceData = '1'; $resume->skillData = '1'; $resume->trainingData = '1';
            $resume->travelData = '1'; $resume->workData = '1'; $resume->status = '1';
            $resume->resumetitleData = '1'; $resume->basicInfoData = '1'; $resume->softskillData = '1';
            $resume->interestData = '1'; $resume->is_visible = '1'; $resume->is_secure = '1';
            $resume->save();
                DB::table('resumes')->where('id', $resume->id)
                                   ->update(['resume_url' => $url."-".$resume->id]);
            return $resume;
        } else {
            $resume = new Resume();
            $resume->ownerEmail = $ownerEmail;
            $resume->userEmail = $userEmail;
            $resume->currentAddressData = '1'; $resume->awardData = '1'; $resume->certificationData = '1';
            $resume->permanentAddressData = '1'; $resume->contactData = '1'; $resume->courseData = '1';
            $resume->educationData = '1'; $resume->languageData = '1'; $resume->objectiveData = '1';
            $resume->patentData = '1'; $resume->profileData = '1'; $resume->projectData = '1';
            $resume->referenceData = '1'; $resume->skillData = '1'; $resume->trainingData = '1';
            $resume->travelData = '1'; $resume->workData = '1'; $resume->status = '1';
            $resume->resumetitleData = '1'; $resume->basicInfoData = '1'; $resume->softskillData = '1';
            $resume->interestData = '1'; $resume->is_visible = '1'; $resume->is_secure = '1';
            $resume->save();
            DB::table('resumes')->where('id', $resume->id)
                                   ->update(['resume_url' => $url."-".$resume->id]);
            return $resume;
        }
    }
    // listing users who viewed my resume
    public static function getResumeAccessedUsersList($user_id) {
        return DB::table('users')
            ->join('resume_stats', 'resume_stats.viewed_by', '=', 'users.id')
            ->leftJoin('contacts', 'contacts.user_id', '=', 'users.id')
            ->where('resume_stats.resume_user_id', $user_id)
            ->where('resume_stats.viewed_by', '!=' ,$user_id)
            ->groupBy('users.id')
            ->orderBy('users.name')->paginate(12);

    }

    // record resume updated time
    public static function recordResumeUpdate($userId) {
        DB::table('users')->where('id', $userId)->update(['resume_updated_at'=>date('Y-m-d H:i:s')]);
    }

    public static function getResumeAccess($ownerEmail, $userEmail){
        $res =  self::where('ownerEmail', $ownerEmail)->where('userEmail', $userEmail)->first();
        if(!$res) {
           return self::createAccessResume($ownerEmail, $userEmail);
        }
        return $res;
    }


}
