<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserAuthLog;
use App\Models\UserMultiAccounts;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function authenticated(\Illuminate\Http\Request $request, $user)
    {
        //
        $this->createUserAuthLog($request, $user);
        $this->checkForMultiAccounts($request, $user);
    }

    public function logout(Request $request) {
        session()->forget('google2fa');

        Auth::logout();
        return redirect('/login');
    }

    public function createUserAuthLog($request, $user) {
        $user_log = new UserAuthLog();
        $user_log->user_id = $user->id;
        $user_log->ip = $request->ip();
        $user->hasAnyRole([
            'admin',
            'root',
        ]) ? $user_log->is_admin = true : $user_log->is_admin = false;
        $user_log->save();
    }

    protected function validateLogin(\Illuminate\Http\Request $request) {
        $request->validate([
            $this->username() => 'required|string',
            'password' => 'required|string',
           /* 'g-recaptcha-response' => config('app.env') == 'production'
                ? 'required|recaptchav3:login,0.5'
                : '',*/
        ], [
     /*       'recaptchav3' => 'Captcha error! Try again',*/
        ]);
    }
    public function checkForMultiAccounts(\Illuminate\Http\Request $request, $user) {
        $current_ip = $request->ip();
        $main_user = User::where('ip', $current_ip)->where('id', '!=', $user->id)->first();
        $main_user_log = UserAuthLog::where('ip', $current_ip)->where('user_id', '!=', $user->id)->first();
        if (!empty($main_user->isEmpty)) {
            $this->createMultiAccountRecord($user, $main_user, $current_ip);
        } else if (!empty($main_user_log)) {
            $this->createMultiAccountRecord($user, $main_user_log->user_id, $current_ip);
        }
    }
    
    public function username(){
        $field = (filter_var(request()->email, FILTER_VALIDATE_EMAIL) || !request()->email) ? 'email' : 'login';
        request()->merge([$field => request()->email]);
        return $field;
    }
    public function createMultiAccountRecord($user, $main_user, $ip) {
        if(!(UserMultiAccounts::where('user_id', $user->id)->where('main_user_id', $main_user)->count() > 0 )){
            $multi_acc = new UserMultiAccounts();
            $multi_acc->user_id = $user->id;
            $multi_acc->main_user_id = $main_user;
            $multi_acc->ip = $ip;
            $multi_acc->save();
        }
    }
}
