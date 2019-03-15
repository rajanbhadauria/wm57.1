<?php
namespace App\Helpers;
use DB;
class Activity {

    // getting activity
    public static function getActivityByType($identifier) {
        return DB::select('activity_list')->where('identifier', $identifier)->first();
    }
    //get notification activity by id
    public static function getUserActivityById($id) {
        return DB::table('notifications')->where('id', $id)->first();
    }

    //creating activity
    public static function createActivity($data) {
        DB::table('notifications')->insert($data);
    }

    // users new activity count
    public static function countUserActivity($user_id, $email) {
       return DB::table('notifications')->select("*")->orWhere('forUser', $user_id)->orWhere('email', $email)->Where('readStatus', '0')->get()->count();

    }

    public static function getUserActivities($user_id, $email) {

        $sql = "SELECT *,N.email as email
                        FROM notifications as N
                        JOIN activity_list AL ON N.activity = AL.identifier
                        WHERE (N.byUser = $user_id AND AL.identifier != 'resume_received')
                        OR N.forUser = $user_id OR N.email = '".$email."'
                        ORDER BY created_at desc";
        return DB::select($sql);
    }

    public static function getUserDetails($user_id) {
       $sql = "SELECT * FROM users
        WHERE (id = $user_id OR email = '".$user_id."') AND 1 = 1";
        $data = DB::select($sql);
        if($data)
            return $data[0];
        else
            return false;
    }


}
