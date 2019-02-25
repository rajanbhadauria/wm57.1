<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

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
}
