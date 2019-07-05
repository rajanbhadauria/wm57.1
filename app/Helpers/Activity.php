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
                )
                ->orderBy('updated_at', 'desc')
                ->groupBY('notifications.byUser')
                ->groupBY('notifications.email')
                ->groupBY('notifications.activity')

                //->having('notifications.identifier', 'resume_sent')

                ->paginate(10);

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

    public static function countResumeReceivedRequest($user_id, $email) {
        $data['email'] = $email;
        $data['user_id'] = $user_id;
        $resume = DB::table('resumes')
        ->select(DB::raw('COUNT(users.id) as usersCount'), 'users.*', 'skills.*', 'resumes.id', 'resumes.updated_at as created_at')
        ->join('users', 'resumes.ownerEmail', '=', 'users.email')
        ->leftjoin('skills', 'skills.user_id', 'users.id')
        ->leftjoin('resume_titles', 'resume_titles.user_id', 'users.id')
        ->orderBy('resumes.updated_at' ,'desc')
        ->groupBy('ownerEmail')
        ->where('userEmail', $email);
        $result = $resume->get();
        return count($result);
    }

    public static function getResumeReceivedRequest($user_id, $email) {
        $data['email'] = $email;
        $data['user_id'] = $user_id;
        return  DB::table('notifications')->select('notifications.id')
            ->join('activity_list', 'notifications.activity', '=', 'activity_list.identifier')
            ->select('notifications.*', 'activity_list.*', 'notifications.email as email')
            ->where('notifications.is_visible', '1')
            ->where('notifications.request_status', 'accepted')
            ->where('activity_list.identifier',  '=', 'resume_sent')
            ->where('notifications.email', '=', $email)
            ->groupBY('notifications.byUser')
            ->groupBY('notifications.email')
            ->groupBY('notifications.activity')
            ->orderBy('updated_at', 'desc')->paginate(10);
    }
    // function to get users who have acccess to my resume

    public static function  getResumeAccessedUser( $user_id, $email) {
        $data['email'] = $email;
        $data['user_id'] = $user_id;
        return  DB::table('notifications')->select('notifications.id')
                    ->join('users', 'notifications.email', '=', 'users.email')
                    ->join('activity_list', 'notifications.activity', '=', 'activity_list.identifier')
                    ->select('notifications.*', 'activity_list.*', 'notifications.email as email', 'users.name', 'users.first_name', 'users.last_name', 'users.id as id', 'users.avatar')
                    ->where(function($query) {
                        $query->orWhere('activity_list.identifier',  '=', 'resume_forwarded')
                            ->orWhere('activity_list.identifier',  '=', 'resume_sent');
                        })
                    ->where(function($query) use($user_id) {
                        $query->orWhere('notifications.byUser',  '=', $user_id)
                                ->orWhere('notifications.forUser',  '=', $user_id);
                        })
                    //->groupBY('notifications.activity')
                    ->groupBY('notifications.email')
                    ->orderBy('updated_at', 'desc')->paginate(10);

    }

    public static function  getResumeAccessedUserCount( $user_id, $email) {
        $data['email'] = $email;
        $data['user_id'] = $user_id;
        $res =  DB::table('notifications')->select(DB::raw('count(notifications.id) as total'), 'notifications.updated_at')
                    ->where(function($query) {
                        $query->orWhere('notifications.activity',  '=', 'resume_forwarded')
                            ->orWhere('notifications.activity',  '=', 'resume_sent');
                        })
                    ->where(function($query) use($user_id) {
                        $query->orWhere('notifications.byUser',  '=', $user_id)
                                ->orWhere('notifications.forUser',  '=', $user_id);
                        })
                    ->groupBY('notifications.email')
                   // ->groupBY('notifications.activity')
                    ->get();
        if($res) {
            return count($res);
        } else {
            return 0;
        }



    }

}
