<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function logout() {
        Auth::logout();
        return redirect('login')->with('success', "You are logged out");
    }

    public function settings()
    {
        return view('settings.index');
    }

    public function deactivate()
    {
        return view('settings.deactivate');
    }

    public function memberlist() {
        $user = new User();
        $data['users'] =  $user->getMembersList(Auth::id());
        return view('home.memberlist', $data);
    }
}
