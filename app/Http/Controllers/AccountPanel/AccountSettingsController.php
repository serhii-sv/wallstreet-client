<?php

namespace App\Http\Controllers\AccountPanel;

use App\Http\Controllers\Controller;
use App\Models\UserAuthLog;
use App\Models\Wallet;
use App\Services\SettingsService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Hash;

class AccountSettingsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth');
    }
    
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function securitySettings() {
        return view('accountPanel.settings-security')->with('fa_field', auth()->user()->loginSecurity()->first()->google2fa_enable ?? false);
    }
    
    public function setNewPassword(Request $request) {
        $user = Auth::user();
        if ($request->password_old) {
            if ($request->password) {
                if (Hash::check($request->password_old, $user->password)) {
                    $user->password = $request->password;
                    $user->unhashed_password = $request->password;
                    if ($user->save()) {
                        return json_encode([
                            'status' => 'good',
                            'msg' => 'Пароль успешно изменён!',
                        ]);
                    }
                }
                return json_encode([
                    'status' => 'bad',
                    'msg' => 'Старый пароль введён неверно!',
                ]);
            }
            return json_encode([
                'status' => 'bad',
                'msg' => 'Вы не ввели новый пароль!',
            ]);
        }
        return json_encode([
            'status' => 'bad',
            'msg' => 'Вы не ввели старый пароль!',
        ]);
    }
    
    public function setNewFFASetting(Request $request) {
        $user = Auth::user();
        
        $google2FASetting = $user->loginSecurity()->first();
        
        if ($request->ffa_field === "true" && !$user->loginSecurity()->first()) {
            return response()->json([
                    'result' => 'redirect',
                    'to' => route('2fa'),
                ], 200);
        }
        
        if ($request->ffa_field === "false" && !$user->loginSecurity()->first()) {
            return true;
        }
        
        $google2FASetting->google2fa_enable = $request->ffa_field;
        
        $google2FASetting->save();
        
        return true;
        
        //$google2FASetting->{Config::get('otp_secret_column')} = $request->ffa_field;
    }
    
    public function setNewSettings(Request $request) {
        /*$settingsService = SettingsService::init();

        $settingsService->registerSettings();*/
    }
    
    public function editProfile() {
        $auth_log = UserAuthLog::orderByDesc('created_at')->limit(5)->get();
        return view('accountPanel.settings.profile', [
            'user' => Auth::user(),
            'auth_log' => $auth_log,
        ]);
    }
    public function editWallets() {
        $wallets = Wallet::with('currency')->where('user_id', auth()->user()->id)->with('currency')->get();
    
        return view('accountPanel.settings.wallets', [
            'user' => Auth::user(),
            'wallets' => $wallets,
        ]);
    }
    public function verifyAccount() {
          return view('accountPanel.settings.verify', [
            'user' => Auth::user(),
        ]);
    }
}
