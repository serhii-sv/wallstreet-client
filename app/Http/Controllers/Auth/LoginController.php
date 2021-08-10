<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\UserAuthLog;
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

    public function username(){
        $field = (filter_var(request()->email, FILTER_VALIDATE_EMAIL) || !request()->email) ? 'email' : 'login';
        request()->merge([$field => request()->email]);
        return $field;
    }
}
