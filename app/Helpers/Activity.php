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
        $sql = "SELECT COUNT(id) as total FROM  notifications WHERE activity != 'resume_received' AND
                                                           activity != 'resume_viewed' AND
                                                           (email = '".$email."'  OR forUser = '".$user_id."')
                                                           AND readStatus = '0'";
       $result = DB::select($sql);
       if(isset($result[0])) {
           return $result[0]->total;
       } else {
           return 0;
       }

    }

    public static function getUserActivities($user_id, $email) {

        $sql = "SELECT *,N.email as email
                        FROM notifications as N
                        JOIN activity_list AL ON N.activity = AL.identifier
                        WHERE (is_visible = '1' AND 1=1) AND (N.byUser = $user_id AND AL.identifier != 'resume_received' AND AL.identifier != 'resume_viewed')
                        OR N.forUser = $user_id OR N.email = '".$email."'

                        ORDER BY created_at desc";
        return DB::select($sql);
    }

    public static function getUserDetails($user_id) {
       $sql = "SELECT * FROM users
        WHERE (id = $user_id OR email = '".$user_id."') AND 1 = 1";
        $data = DB::select($sql);
        if(count($data)>0)
            return $data[0];
        else
            return false;
    }


}
