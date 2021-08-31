<?php

namespace App\Http\Middleware;

use App\Models\Permission;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Exceptions\UnauthorizedException;

class CheckPermissions
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $authGuard = app('auth')->guard('web');
    
        if ($authGuard->guest()) {
            throw UnauthorizedException::notLoggedIn();
        }
        $route_name = $request->route()->getName();
        $permission = Permission::where('slug', $route_name)->first();
        
        if (!empty($permission)){
            
            if (Auth::check() && Auth::user()->can($permission->name)){
                return $next($request);
            }else{
                abort(403,'У вас не достаточно прав!');
            }
        }
        return $next($request);
    }
}
