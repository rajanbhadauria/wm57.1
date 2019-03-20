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
    // record resume updated time
    public static function recordResumeUpdate($userId) {
        DB::table('users')->where('id', $userId)->update(['resume_updated_at'=>date('Y-m-d H:i:s')]);
    }
}
