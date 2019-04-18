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
    public function getMembersList($userId, $query = '', $sortBy = "name") {
        $result =  User::leftjoin('work', 'work.user_id' ,'=','users.id')
                    ->leftjoin('skills', 'skills.user_id','=','users.id')
                    ->where('status', '1')
                    ->where('users.role', '3')
                    ->where('users.id', '!=', $userId)
                    ->where('users.account_status', 'active');
                    if($query != '') {
                        $result->where(function($sql) use($query){
                            $sql->orWhere('users.name', 'like', '%'.$query.'%')
                                ->orWhere('work.company', 'like', '%'.$query.'%')
                                ->orWhere('skills.skill', 'like', '%:"'.$query.'"%');
                        });
                    }
                    if($sortBy == "name") {
                        $result->orderBy('users.name');
                    }
                    if($sortBy == "company") {
                        $result->orderBy('users.company');
                    }
                    if($sortBy == "last_active") {
                        $result->orderBy('users.last_active', 'desc');
                    }
                    $result->groupBy('users.id');
                    return $result->get();
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
        $query = User::leftjoin('contacts', 'contacts.user_id', '=', 'users.id')
                    ->select('*', 'users.created_at as created_at')
                    ->where(function ($mainQuery) use($userId) {
                        $mainQuery->orwhereIn('users.id', function($query) use ($userId){
                            $query->select('requested_by')
                                  ->from('user_relations')
                                  ->where(function ($query) use ($userId){
                                    $query->orWhere('requested_by', $userId)
                                         ->orWhere('requested_to', $userId);
                                  });
                        })
                        ->orwhereIn('users.id', function($query) use ($userId){
                            $query->select('requested_to')
                                  ->from('user_relations')
                                  ->where(function ($query) use ($userId){
                                    $query->orWhere('requested_by', $userId)
                                         ->orWhere('requested_to', $userId);
                                  });
                        });
                    })
                    ->where('users.id', '!=', $userId);
        return $query->get();
    }



}
