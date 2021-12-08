<?php

namespace App\Http\Controllers;

use App\Models\LoginSecurity;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class LoginSecurityController extends Controller
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
     * Show 2FA Setting form
     */
    public function show2faForm(Request $request){
        /** @var User $user */
        $user = Auth::user();
        $google2fa_url = "";
        $secret_enabled = false;
        $secret_key = "";

        $loginSecurity = $user->loginSecurity()->first();

        if(null !== $loginSecurity){
            $google2fa = (new \PragmaRX\Google2FAQRCode\Google2FA());
            $google2fa_url = $google2fa->getQRCodeInline(
                config('app.name'),
                $user->email,
                $loginSecurity->google2fa_secret
            );
            $secret_key = $loginSecurity->google2fa_secret;
            $secret_enabled = $loginSecurity->google2fa_enable;
        }

        $data = array(
            'user' => $user,
            'secret' => $secret_key,
            'google2fa_url' => $google2fa_url,
            'secret_enabled' => $secret_enabled,
        );

        return view('auth.2fa_settings')->with($data);
    }

    /**
     * Generate 2FA secret key
     */
    public function generate2faSecret(Request $request){
        $user = Auth::user();
        // Initialise the 2FA class
        $google2fa = (new \PragmaRX\Google2FAQRCode\Google2FA());

        // Add the secret key to the registration data
        $login_security = LoginSecurity::firstOrNew(array('user_id' => $user->id));
        $login_security->user_id = $user->id;
        $login_security->google2fa_enable = 0;
        $login_security->google2fa_secret = $google2fa->generateSecretKey();
        $login_security->save();

        return redirect('/2fa')->with('success',"Секретный ключ сгенерирова успешно");
    }

    /**
     * Enable 2FA
     */
    public function enable2fa(Request $request){
        $user = Auth::user();
        $google2fa = (new \PragmaRX\Google2FAQRCode\Google2FA());

        $secret = $request->input('secret');
        $valid = $google2fa->verifyKey($user->loginSecurity->google2fa_secret, $secret);

        if($valid){
            $user->loginSecurity->google2fa_enable = true;
            $user->loginSecurity->save();
            return redirect('dashboard')->with('success',"2FA включена успешно.");
        }else{
            return redirect('2fa')->with('error',"Неверный код верификации, попробуйте пожалуйста позже.");
        }
    }

    /**
     * Disable 2FA
     */
    public function disable2fa(Request $request){
        if (!(Hash::check($request->get('current-password'), Auth::user()->password))) {
            // The passwords matches
            return redirect()->back()->with("error","Пароль не совпадает с текущим, пожалуйста повторите");
        }

        $validatedData = $request->validate(
            [
            'current-password' => 'required',
        ],
            [
                'current-password.required' => 'Поле :attribute обязательно'
            ]
        );
        $user = Auth::user();
        $user->loginSecurity->google2fa_enable = false;
        $user->loginSecurity->save();
        return redirect('/2fa')->with('success',"2FA отключена.");
    }
}
