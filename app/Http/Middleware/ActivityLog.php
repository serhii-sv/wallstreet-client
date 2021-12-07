<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ActivityLog
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
        \App\Models\ActivityLog::setActivityLog();
        return $next($request);
    }
}
