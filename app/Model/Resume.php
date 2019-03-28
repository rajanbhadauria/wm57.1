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
    // listing users who viewed my resume
    public static function getResumeAccessedUsersList($user_id) {
        return DB::table('users')
            ->join('resume_stats', 'resume_stats.viewed_by', '=', 'users.id')
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
        return self::where('ownerEmail', $ownerEmail)->where('userEmail', $userEmail)->first();
    }
}
