<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class IndexController extends Controller
{
    public function index() {
        $user = new User();
        $data['users'] =  $user->getAllMembers();
        $data['user_counts'] =  $user->countAllMembers();
        return view('index', $data);
    }

    public function terms() {
        return view('terms');
    }

    public function policy() {
        return view('policy');
    }
}
