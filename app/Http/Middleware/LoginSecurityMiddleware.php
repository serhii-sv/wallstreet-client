<?php

namespace App\Http\Middleware;

use App\Models\LoginSecurity;
use App\Support\Google2FAAuthenticator;
use Closure;
use Illuminate\Support\Facades\Auth;

class LoginSecurityMiddleware
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
        if (false === Auth::user()->isImpersonated()) {
            $authenticator = app(Google2FAAuthenticator::class)->boot($request);

            if ($authenticator->isAuthenticated()) {
                return $next($request);
            }

            return $authenticator->makeRequestOneTimePasswordResponse();
        }

        return $next($request);
    }
}
