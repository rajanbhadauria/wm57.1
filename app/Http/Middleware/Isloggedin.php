<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;
use Closure;

class Isloggedin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        //die("'".Auth::guest()."'");
        if(Auth::guest() == "") {
            return redirect('/home')->with('success', 'You are already logged in');
        }
        return $next($request);
    }
}
