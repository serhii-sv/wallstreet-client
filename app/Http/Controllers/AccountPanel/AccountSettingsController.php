<?php

namespace App\Http\Controllers\AccountPanel;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Models\UserAuthLog;
use App\Models\UserPhoneMessages;
use App\Models\Wallet;
use App\Services\SettingsService;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Hash;
use Twilio\Rest\Client;
use Twilio\TwiML\Voice\Number;

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
        $verification_enable = Setting::where('s_key', 'verification_enable')->first();
        $verification_enable = $verification_enable !== null ? $verification_enable->s_value : 'off';
        $auth_log = UserAuthLog::orderByDesc('created_at')->limit(5)->get();

        return view('accountPanel.settings.settings-security')->with([
            'fa_field' => auth()->user()->loginSecurity()->first()->google2fa_enable ?? false,
            'user' => Auth::user(),
            'verification_enable' => $verification_enable,
            'auth_log' => $auth_log,
        ]);
    }

    public function setNewPassword(Request $request)
    {
        $user = Auth::user();
        if ($request->password_old) {
            if ($request->password) {
                if (Hash::check($request->password_old, $user->password)) {
                    $user->password = Hash::make($request->password);
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

    public function setNewFFASetting(Request $request)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        $google2FASetting = $user->loginSecurity;

        if ($request->ffa_field === "true" && null == $google2FASetting) {
            return response()->json([
                'result' => 'redirect',
                'to' => route('2fa'),
            ], 200);
        }

        if ($request->ffa_field === "false" && null == $google2FASetting) {
            return true;
        }

        $google2FASetting->delete();

        return true;

        //$google2FASetting->{Config::get('otp_secret_column')} = $request->ffa_field;
    }

    public function setNewSettings(Request $request)
    {
        /*$settingsService = SettingsService::init();

        $settingsService->registerSettings();*/
    }

    public function editProfile()
    {
        return view('accountPanel.settings.profile', [
            'user' => Auth::user(),
        ]);
    }

    public function editWallets()
    {
        $wallets = Wallet::with('currency')->where('user_id', auth()->user()->id)->with('currency')->get();

        return view('accountPanel.settings.wallets', [
            'user' => Auth::user(),
            'wallets' => $wallets,
        ]);
    }

    public function verifyAccount()
    {
        return view('accountPanel.settings.verify', [
            'user' => Auth::user(),
        ]);
    }

    public function updatePhone(Request $request)
    {
        $request->validate(
            [
                'phone' => 'max:255',
            ],
            [
                'phone.max' => 'Поле телефон не должно быть больше чем :max',
            ]
        );
        $phone = $request->get('phone');
        $user = Auth::user();
        if ($phone == $user->phone && $user->phone_verified == true) {
            $phone_verified = true;
        } else {
            $phone_verified = false;
        }
        $user->update([
            'phone' => $phone,
            'phone_verified' => $phone_verified,
        ]);
        return redirect()->back()->with('success', 'Данные обновлены!');
    }

    public function showEnterVerifyCode()
    {
        $verification_enable = Setting::where('s_key', 'verification_enable')->first();
        if ($verification_enable !== null) {
            if (!($verification_enable->s_value == 'on')) {
                return redirect()->route('accountPanel.settings.verify.phone')->with('error', 'Верификация отключена');
            }
        } else {
            return redirect()->route('accountPanel.settings.verify.phone')->with('error', 'Верификация отключена');
        }
        if (!(Auth::user()->phone)) {
            return redirect()->route('accountPanel.settings.verify.phone')->with('error', 'Телефон не указан');
        }
        if (Auth::user()->phone_verified) {
            return redirect()->route('accountPanel.settings.verify.phone')->with('error', 'Телефон Уже верифицирован');
        }

        $last_sms = UserPhoneMessages::where('user_id', Auth::user()->id)->where('type', 'verification')->where('created_at', '>', Carbon::now()->subMinutes(5))->where('used', false)->orderByDesc('created_at')->first();

        return view('accountPanel.settings.enter-verify-code', [
            'last_sms' => $last_sms,
        ]);
    }

    public function sendVerifyCode()
    {
        $verification_enable = Setting::where('s_key', 'verification_enable')->first();
        if ($verification_enable !== null) {
            if (!($verification_enable->s_value == 'on')) {
                return redirect()->route('accountPanel.settings.verify.phone')->with('error', 'Верификация отключена');
            }
        } else {
            return redirect()->route('accountPanel.settings.verify.phone')->with('error', 'Верификация отключена');
        }
        if (!(Auth::user()->phone)) {
            return redirect()->route('accountPanel.settings.verify.phone')->with('error', 'Телефон не указан');
        }
        if (Auth::user()->phone_verified) {
            return redirect()->route('accountPanel.settings.verify.phone')->with('error', 'Телефон Уже верифицирован');
        }

        $dispatch_method = Setting::where('s_key', 'verification_type')->first();
        $account_sid = env("TWILIO_ACCOUNT_SID");
        $auth_token = env("TWILIO_AUTH_TOKEN");
        $twilio_number = env("TWILIO_PHONE_NUMBER");
        $code = $this->generatePIN(4);
        $client = new Client($account_sid, $auth_token);


        if ($dispatch_method->s_value == 'voice') {
            try {
                $client->calls->create(Auth::user()->phone, // to
                    $twilio_number, // from
                    // ["url" => route('accountPanel.verify.voice.text.xml', $code)]
                    ["url" => 'https://demo.twilio.com/docs/voice.xml']);
            } catch (\Exception $e) {
                return back()->with('error', 'Ошибка звонка на номер ' . Auth::user()->phone);
            }

            $statusCode = $client->getHttpClient()->lastResponse->getStatusCode(); // ->lastResponse->getHeaders()
            if ($statusCode == '201') {
                $sms = new UserPhoneMessages();
                $sms->user_id = Auth::user()->id;
                $sms->code = $code;
                $sms->type = 'verification';
                $sms->dispatch_method = $dispatch_method->s_value;
                $sms->save();
            }
        } else {
            $last_sms = UserPhoneMessages::where('user_id', Auth::user()->id)->where('type', 'verification')->where('created_at', '>', Carbon::now()->subMinutes(5))->where('used', false)->orderByDesc('created_at')->first();
            if ($last_sms === null) {

                $text = Setting::where('s_key', 'verification_text')->first();

                try {
                    $client->messages->create(// Where to send a text message (your cell phone?)
                        Auth::user()->phone, [
                        'from' => $twilio_number,
                        'body' => $text->s_value . ' ' . $code,
                    ]);
                } catch (\Exception $e) {
                    return back()->with('error', 'Ошибка отправки смс на номер ' . Auth::user()->phone);
                }

                $statusCode = $client->getHttpClient()->lastResponse->getStatusCode(); // ->lastResponse->getHeaders()
                if ($statusCode == '201') {
                    $sms = new UserPhoneMessages();
                    $sms->user_id = Auth::user()->id;
                    $sms->code = $code;
                    $sms->type = 'verification';
                    $sms->dispatch_method = $dispatch_method->s_value;
                    $sms->save();
                }
            }
        }
        return redirect()->route('accountPanel.settings.enter.verify.code');
    }

    public function verifyPhone(Request $request)
    {
        $verification_enable = Setting::where('s_key', 'verification_enable')->first();
        if ($verification_enable !== null) {
            if (!($verification_enable->s_value == 'on')) {
                return redirect()->route('accountPanel.settings.verify.phone')->with('error', 'Верификация отключена');
            }
        } else {
            return redirect()->route('accountPanel.settings.verify.phone')->with('error', 'Верификация отключена');
        }
        if (Auth::user()->phone == null) {
            return redirect()->route('accountPanel.settings.verify.phone')->with('error', 'Телефон не указан');
        }
        if (Auth::user()->phone_verified) {
            return redirect()->route('accountPanel.settings.verify.phone')->with('error', 'Телефон Уже верифицирован');
        }
        $last_sms = UserPhoneMessages::where('user_id', Auth::user()->id)->where('type', 'verification')->where('created_at', '>', Carbon::now()->subMinutes(5))->where('used', false)->orderByDesc('created_at')->first();
        if ($last_sms === null) {
            return redirect()->route('accountPanel.settings.enter.verify.code')->with('error', 'Код не верный!');
        } else {
            if ($last_sms->code == $request->get('code')) {
                $last_sms->update([
                    'used' => true,
                ]);
                Auth::user()->update([
                    'phone_verified' => true,
                ]);
                return redirect()->route('accountPanel.settings.verify.phone')->with('success', 'Телефон успешно верифицирован!');
            }
        }
        return redirect()->route('accountPanel.settings.enter.verify.code')->with('error', 'Код не верный!');
    }

    public function showVerifyVoiceTextXml($code)
    {
        $text = Setting::where('s_key', 'verification_voice_text')->first();
        return response()->view('accountPanel.settings.verify-voice-text-xml', compact('text, code'))->header('Content-Type', 'text/xml');
    }

    public function updateAuthWithPhone(Request $request)
    {
        $verification_enable = Setting::where('s_key', 'verification_enable')->first();
        if ($verification_enable !== null) {
            if (!($verification_enable->s_value == 'on')) {
                return redirect()->route('accountPanel.settings.verify.phone')->with('error', 'Верификация отключена');
            }
        } else {
            return redirect()->route('accountPanel.settings.verify.phone')->with('error', 'Верификация отключена');
        }

        if (!Auth::user()->phone_verified) {
            return redirect()->route('accountPanel.settings.verify.phone')->with('error', 'Номер не верифицирован!');
        }
        if ($request->get('auth_with_phone')) {
            $auth_with_phone = true;
        } else {
            $auth_with_phone = false;
        }
        if (Auth::user()->update([
            'auth_with_phone' => $auth_with_phone,
        ])) {
            return redirect()->route('accountPanel.settings.verify.phone')->with('success', 'Данные сохранены!');
        }
        return redirect()->route('accountPanel.settings.verify.phone')->with('error', 'Данные не сохранены!');
    }

//    public function generatePIN($digits = 4) {
//        $i = 0;
//        $pin = "";
//        if ($digits < 1) {
//            return null;
//        }
//        while ($i < $digits) {
//            $pin .= mt_rand(0, 9);
//            $i++;
//        }
//        return $pin;
//    }
}
