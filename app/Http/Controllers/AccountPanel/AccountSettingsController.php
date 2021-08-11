<?php

namespace App\Http\Controllers\AccountPanel;

use App\Http\Controllers\Controller;
use App\Services\SettingsService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;

class AccountSettingsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function securitySettings()
    {
        return view('accountPanel.settings-security')
            ->with('fa_field', auth()->user()->loginSecurity()->first()->google2fa_enable ?? false);
    }

    public function setNewPassword(Request $request){
        $user = Auth::user();
        $user->password = $request->password;
        $user->unhashed_password = $request->password;

        $user->save();

        return true;
    }

    public function setNewFFASetting(Request $request){
        $user = Auth::user();

        $google2FASetting = $user->loginSecurity()->first();

        if($request->ffa_field === "true" && !$user->loginSecurity()->first()){
            return response()
                ->json([
                    'result' => 'redirect',
                    'to' => route('2fa')
                ], 200);
        }

        if($request->ffa_field === "false" && !$user->loginSecurity()->first()) {
            return true;
        }

        $google2FASetting->google2fa_enable = $request->ffa_field;

        $google2FASetting->save();

        return true;

        //$google2FASetting->{Config::get('otp_secret_column')} = $request->ffa_field;
    }

    public function setNewSettings(Request $request)
    {
        /*$settingsService = SettingsService::init();

        $settingsService->registerSettings();*/
    }
}
