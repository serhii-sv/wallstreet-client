<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LockedUser
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure                 $next
     *
     * @return mixed
     */
    public function handle(Request $request, Closure $next) {
        if (Session::has('last_activity')){
            if (Session::get('last_activity') < now()->subMinute(60)){
                return redirect()->route('user.lock');
            }
            Session::put('last_activity', now());
        }else{
            Session::put('last_activity', now());
        }
        if (Session::has('locked') && Session::get('locked') == true) {
            return redirect()->route('user.locked');
        }
         return $next($request);
    }
}
