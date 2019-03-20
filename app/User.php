<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use DB;
class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'first_name', 'last_name', 'email', 'password','status', 'role','activate_token', 'social_type', 'wmid'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    // getting all registed active members
    public function getAllMembers($isActive = "1") {
        return User::where('status', $isActive)
                    ->where('role', '3')
                    ->where('account_status', 'active')
                    ->limit(5)
                    ->inRandomOrder()
                    ->get();
    }
    // counting all registered active members
    public function countAllMembers($isActive = "1") {
        $users =  User::where('status', $isActive)
                    ->where('role', '3')
                    ->where('account_status', 'active')
                    ->get()->toArray();
        return count($users);
    }

    // get all members except loged in user
    public function getMembersList($userId) {
        return User::where('status', '1')
                    ->where('role', '3')
                    ->where('id', '!=', $userId)
                    ->where('account_status', 'active')
                    ->inRandomOrder()
                    ->get();
    }
    // create contact list afteruser gets signup
    public static function contactListInit($email, $userId) {
        $invitations = DB::table('user_invitations')->where('invited_email', $email)->get();
        if($invitations) {
            foreach($invitations as $invitaion) {
                $insert['requested_by'] = $invitaion->invited_by;
                $insert['requested_to'] = $userId;
                DB::table('user_relations')->insert($insert);
            }
        }
    }

    //get users contact list users
    public static function getMyContacts($userId) {
       $sql = "SELECT U.* FROM `user_relations` as UR
                                    JOIN users as U ON U.id = UR.requested_by
                                    JOIN users U2 ON U2.id = UR.requested_to
                                    WHERE (UR.requested_by = ".$userId." OR UR.requested_to = ".$userId.")
                                    AND U.id != ".$userId." GROUP BY U.id";
        $result = DB::select($sql);
        if($result) {
            return $result;
        }
        return $result;
    }
    // check if user exists by email
    public function getuserByEmail($email) {
        return this::where('email', $email)->first();
    }
}
