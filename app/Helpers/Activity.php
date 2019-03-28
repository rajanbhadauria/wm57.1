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

        $data['email'] = $email;
        $data['user_id'] = $user_id;
        return  DB::table('notifications')
            ->join('activity_list', 'notifications.activity', '=', 'activity_list.identifier')
            ->select('notifications.*', 'activity_list.*', 'notifications.email as email')
            ->where('is_visible', '1')
            ->where('activity_list.identifier',  '!=', 'resume_received')
            ->where('activity_list.identifier',  '!=', 'resume_viewed')
            ->where(function($query) use ($data){
                        $query->orWhere('notifications.forUser', '=', $data['user_id'])
                              ->orWhere('notifications.email', '=', $data['email'])
                              ->orWhere('notifications.byUser', $data['user_id']);
                    }
                )->orderBy('updated_at', 'desc')->paginate(5);

    }

    public static function getUserDetails($user_id) {
       $sql = "SELECT * FROM users
        WHERE (id = '".$user_id."' OR email = '".$user_id."') AND 1 = 1";
        $data = DB::select($sql);
        if(count($data)>0)
            return $data[0];
        else
            return false;
    }

    public static function getResumeAccessRequest($user_id, $email) {
        $data['email'] = $email;
        $data['user_id'] = $user_id;
        return  DB::table('notifications')
            ->join('activity_list', 'notifications.activity', '=', 'activity_list.identifier')
            ->select('notifications.*', 'activity_list.*', 'notifications.email as email')
            ->where('notifications.is_visible', '1')
            ->where('notifications.request_status', 'pending')
            ->where('activity_list.identifier',  '=', 'resume_request')
            ->where('notifications.forUser', '=', $data['user_id'])
            ->orderBy('updated_at', 'desc')->paginate(10);
    }

    public static function getResumeReceivedRequest($user_id, $email) {
        $data['email'] = $email;
        $data['user_id'] = $user_id;
        return  DB::table('notifications')
            ->join('activity_list', 'notifications.activity', '=', 'activity_list.identifier')
            ->select('notifications.*', 'activity_list.*', 'notifications.email as email')
            ->where('notifications.is_visible', '1')
            ->where('notifications.request_status', 'accepted')
            ->where('activity_list.identifier',  '=', 'resume_sent')
            ->where('notifications.email', '=', $email)
            ->orderBy('updated_at', 'desc')->paginate(10);
    }
}
