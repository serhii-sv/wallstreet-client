<?php

namespace App\Http\Middleware;

use App\Models\UserPhoneMessages;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class CheckAuthCode
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
        if (Auth::user()->phone == null) {
            return $next($request);
        }
        if (Auth::user()->auth_with_phone) {
        
        }
        return $next($request);
    }
}
