<?php

namespace App\Http\Middleware;

use App\Models\Setting;
use App\Models\UserDevice;
use App\Models\UserPhoneMessages;
use Closure;
use hisorange\BrowserDetect\Parser;
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
        $user = Auth::user();

        if (false === $user->isImpersonated()) {
            $verification_enable = Setting::where('s_key', 'verification_enable')->first();

            if ($verification_enable !== null) {
                if ($verification_enable->s_value == 'off') {
                    return $next($request);
                }
            }

            if ($user->phone == null || $user->auth_with_phone == false) {
                return $next($request);
            }

            $browser = Parser::browserFamily();
            $browser_version = Parser::browserVersion();
            $device_platform = Parser::platformName();
            $user_device = UserDevice::where('user_id', $user->id)
                ->where('ip', $request->ip())
                ->where('browser', $browser)
                ->where('browser_version', $browser_version)
                ->where('device_platform', $device_platform)
                ->first();

            if ($user_device !== null) {
                if ($user_device->sms_verified) {
                    return $next($request);
                } else {
                    return redirect()->route('login.send.verify.code');
                }
            } else {
                return redirect()->route('login.send.verify.code');
            }
        }

        return $next($request);
    }
}
