<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckSiteEnabled
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
        if (\App\Models\Setting::getValue('disable_client_site', '', true) == 'true') {
            return redirect()->to(route('site-disabled'));
        }
        return $next($request);
    }
}
