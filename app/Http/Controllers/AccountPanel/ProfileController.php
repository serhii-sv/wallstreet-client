<?php

namespace App\Http\Controllers\AccountPanel;

use App\Http\Controllers\Controller;
use App\Models\CloudFile;
use App\Models\CloudFileFolder;
use App\Models\Language;
use App\Models\PaymentSystem;
use App\Models\Setting;
use App\Models\User;
use App\Models\UserAuthLog;
use App\Models\UserDevice;
use App\Models\UserPhoneMessages;
use App\Models\Wallet;
use hisorange\BrowserDetect\Parser;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Twilio\Rest\Client;

class ProfileController extends Controller
{

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit() {
        $wallets = Wallet::with('currency')->where('user_id', auth()->user()->id)->with('currency')->get();

        $auth_log = UserAuthLog::orderByDesc('created_at')->limit(5)->get();
        return view('accountPanel.profile.edit', [
            'user' => Auth::user(),
            'auth_log' => $auth_log,
            'wallets' => $wallets,
        ]);
    }

    public function updateWalletDetails(Request $request) {
        $request->validate([
            'user_id' => 'required|uuid',
            'wallet_id' => 'required|uuid',
            'currency_id' => 'required|uuid',
            'external' => 'max:255',
        ]);

        $external = $request->get('external');
        $user_id = $request->get('user_id');
        $wallet_id = $request->get('wallet_id');
        $currency_id = $request->get('currency_id');

        if ($user_id !== auth()->user()->id) {
            return redirect()->back()->with('error', 'Жулик!');
        }

        $wallet = Wallet::where('id', $wallet_id)->where('user_id', $user_id)->where('currency_id', $currency_id)->first();
        if ($wallet === null) {
            return redirect()->back()->with('error', 'Попробуй заново!');
        }

        $wallet->external = $external;
        $wallet->external_payeer = $request->has('external_payeer')
            ? $request->external_payeer
            : null;
        $wallet->save();

        return redirect()->back()->with('success', 'Данные успешно сохранены!');
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request) {
        $request->validate([
            'login' => 'required|min:3|unique:users,login,' . Auth::user()->id,
            'email' => 'required|min:3|unique:users,email,' . Auth::user()->id,
            'name' => 'required|min:2',
        ]);
        $phone = $request->get('phone');
        $user = Auth::user();
        if ($phone == $user->phone && $user->phone_verified == true) {
            $phone_verified = true;
        } else {
            $phone_verified = false;
        }
        $user->update($request->except('_method', 'phone_verified'));
        $user->update(['phone_verified' => $phone_verified]);
        return redirect()->route('accountPanel.settings.profile')->with('success', 'Данные успешно изменены!');
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|void
     */
    public function updatePhoto(Request $request) {
        $request->validate([
            'avatar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $file = $request->file('avatar');
        $folder_id = $request->folder_id;
        $newName = md5($file->getClientOriginalName() . rand(0, 1000000) . microtime()) . '.' . $file->getExtension();

        try {
            DB::transaction(function () use ($newName, $file, $folder_id) {
                if (!is_null($folder_id)) {
                    $folder = CloudFileFolder::findOrFail($folder_id);
                    $upload = Storage::disk('do_spaces')->putFileAs($folder->folder_name, $file, $newName);
                } else {
                    $upload = Storage::disk('do_spaces')->put($newName, $file, 'private');
                }

                $user = auth()->user();
                /** @var User $createdBy */
                $createdBy = $user;

                $cloudFile = CloudFile::create([
                    'created_by' => $createdBy->id,
                    'name' => strtolower($file->getClientOriginalName()),
                    'ext' => $file->getExtension(),
                    'mime' => $file->getMimeType(),
                    'url' => $upload,
                    'cloud_file_folder_id' => $folder_id,
                    'last_access' => null,
                    'size' => $file->getSize(),
                ]);

                $user->avatar = $cloudFile->id;
                $user->save();
            });
        } catch (\Exception $exception) {
            die($exception->getMessage());
        }

        return redirect()->route('accountPanel.settings.profile', !is_null($folder_id) ? ['folder' => $folder_id] : [])->with('success', 'Файл успешно загружен');
    }

    /**
     * @param $id
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function getAvatar($id) {
        $avatar_id = User::findOrFail($id)->avatar;

        $file = CloudFile::findOrFail($avatar_id);
        $fileFromStorage = Storage::disk('do_spaces')->get($file->url);

        return response($fileFromStorage, 200, [
            'Content-type' => $file->mime,
        ]);
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function uploadDocuments(Request $request) {
        $validator = Validator::make($request->all(), [
            'passportImage' => 'required|mimes:jpeg,gif,png,bmp',
            'selfie' => 'required|mimes:jpeg,gif,png,bmp',
        ], [
            'passportImage.required' => 'Фото паспорта обязятельно',
            'passportImage.mimes' => 'Неверный формат файла для фото паспорта',

            'selfie.required' => 'Селфи обязятельно',
            'selfie.mimes' => 'Неверный формат файла для селфи',

            'full_name.required' => 'Поле имени обязательно',
            'full_name.max' => 'Максимальное количество символов 255',
        ]);

        if (count($validator->errors()->messages())) {
            return back()->with('short_error_array', $validator->errors()->messages());
        }

        $passportFile = $request->file('passportImage');
        $selfie = $request->file('selfie');

        try {
            DB::transaction(function () use ($passportFile, $selfie, $request) {
                $newName = md5($passportFile->getClientOriginalName() . rand(0, 1000000) . microtime()) . '.' . $passportFile->getExtension();
                $passportFile = Storage::disk('do_spaces')->putFileAs('user_verification_documents', $passportFile, $newName);

                $newName = md5($selfie->getClientOriginalName() . rand(0, 1000000) . microtime()) . '.' . $selfie->getExtension();
                $selfie = Storage::disk('do_spaces')->putFileAs('user_verification_documents', $selfie, $newName);

                Storage::disk('do_spaces')->setVisibility($passportFile, 'public');
                Storage::disk('do_spaces')->setVisibility($selfie, 'public');

                $user = auth()->user();

                $user->verifiedDocuments()->create([
                    'passport_image' => $passportFile,
                    'selfie_image' => $selfie,
                ]);
            });
        } catch (\Exception $exception) {
            return back()->with('short_error', $exception->getMessage());
        }

        return back()->with('short_success', 'Заявка на подтверждение личности создана');
    }

    public function loginSendVerifyCode(Request $request) {
        $verification_enable = Setting::where('s_key', 'verification_enable')->first();
        if ($verification_enable !== null){
            if (!($verification_enable->s_value == 'on'))
            {
                return redirect()->route('accountPanel.dashboard');
            }
        }else{
            return redirect()->route('accountPanel.dashboard');
        }

        if (!Auth::user()) {
            return redirect()->route('accountPanel.dashboard');
        }
        if (!Auth::user()->phone){
            return redirect()->route('accountPanel.dashboard');
        }

//        if (!Auth::user()->phone_verified) {
//            return redirect()->route('accountPanel.dashboard');
//        }

        $browser = Parser::browserFamily();
        $browser_version = Parser::browserVersion();
        $device_platform = Parser::platformName();
        $user_device = UserDevice::where('user_id', Auth::user()->id)
            ->where('ip', $request->ip())
            ->where('browser', $browser)
            ->where('browser_version', $browser_version)
            ->where('device_platform', $device_platform)
            ->first();

        if ($user_device !== null){
            if ($user_device->sms_verified){
                return redirect()->route('accountPanel.dashboard');
            }
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
                return back()->with('error', 'Ошибка звонка на номер '.Auth::user()->phone);
            }

            $statusCode = $client->getHttpClient()->lastResponse->getStatusCode(); // ->lastResponse->getHeaders()
            if ($statusCode == '201') {
                $sms = new UserPhoneMessages();
                $sms->user_id = Auth::user()->id;
                $sms->code = $code;
                $sms->type = 'auth';
                $sms->dispatch_method = $dispatch_method->s_value;
                $sms->save();
            }
        } else {
            $last_sms = UserPhoneMessages::where('user_id', Auth::user()->id)
                ->where('type', 'verification')
                ->where('created_at', '>', Carbon::now()->subMinutes(5))
                ->where('used', false)
                ->orderByDesc('created_at')
                ->first();

            if ($last_sms === null) {
                $text = Setting::where('s_key', 'verification_text')->first();

                try {
                    $client->messages->create(// Where to send a text message (your cell phone?)
                        Auth::user()->phone, [
                        'from' => $twilio_number,
                        'body' => $text->s_value . ' ' . $code,
                    ]);
                } catch (\Exception $e) {
                    return back()->with('error', 'Ошибка отправки смс на номер '.Auth::user()->phone);
                }

                $statusCode = $client->getHttpClient()->lastResponse->getStatusCode(); // ->lastResponse->getHeaders()

                if ($statusCode == '201') {
                    $sms = new UserPhoneMessages();
                    $sms->user_id = Auth::user()->id;
                    $sms->code = $code;
                    $sms->type = 'auth';
                    $sms->dispatch_method = $dispatch_method->s_value;
                    $sms->save();
                }
            }
        }

        return redirect()->route('login.enter.verify.code');
    }

    public function enterVerifyLoginCode() {
        if (!Auth::user()) {
            return back();
        }

        $last_sms = UserPhoneMessages::where('user_id', Auth::user()->id)
            ->where('type', 'auth')
            ->where('created_at', '>', Carbon::now()->subMinutes(5))
            ->where('used', false)
            ->orderByDesc('created_at')
            ->first();

        return view('auth.verify-code', [
            'last_sms' => $last_sms,
        ]);
    }

    public function verifyCode(Request $request) {
        /** @var User $user */
        $user = auth()->user();

        /** @var UserPhoneMessages $last_sms */
        $last_sms = UserPhoneMessages::where('user_id', $user->id)
            ->where('type', 'auth')
            ->where('created_at', '>', Carbon::now()->subMinutes(5))
            ->where('used', false)
            ->orderByDesc('created_at')
            ->first();

        $browser = Parser::browserFamily();
        $browser_version = Parser::browserVersion();
        $device_platform = Parser::platformName();
        $user_device = UserDevice::where('user_id', Auth::user()->id)
              ->where('ip', $request->ip())
              ->where('browser', $browser)
              ->where('browser_version', $browser_version)
              ->where('device_platform', $device_platform)
              ->first();

        if ($request->has('phone') && !empty($request->phone) && !$user->phone_verified && $user->phone != $request->phone) {
            $user->phone = trim($request->phone);
            $user->save();

            if (null !== $last_sms) {
                $last_sms->used = true;
                $last_sms->save();
            }

            return redirect()->route('login.send.verify.code');
        }

        if ($request->has('skip_code') && !$user->phone_verified) {
          if (null !== $last_sms)
          {
            $last_sms->update([
                'used' => true,
            ]);
          }

          if (null !== $user_device) {
            $user_device->sms_verified = true;
            $user_device->save();
          }

          return redirect()->route('accountPanel.dashboard');
        }

        $verification_enable = Setting::where('s_key', 'verification_enable')->first();
        if ($verification_enable !== null){
            if (!($verification_enable->s_value == 'on'))
            {
                return redirect()->route('accountPanel.dashboard');
            }
        }else{
            return redirect()->route('accountPanel.dashboard');
        }
        if (!(Auth::user()->phone)){
            return redirect()->route('accountPanel.dashboard');
        }
//        if (!(Auth::user()->phone_verified)) {
//            return redirect()->route('accountPanel.dashboard');
//        }

        if ($user_device !== null){
            if ($user_device->sms_verified){
                return redirect()->route('accountPanel.dashboard');
            }
        }else{
            $user_device = new UserDevice();
            $user_device->user_id = Auth::id();
            $user_device->ip = $request->ip();
            $user_device->browser = $browser;
            $user_device->browser_version = $browser_version;
            $user_device->device_platform = $device_platform;
            $user_device->sms_verified = false;
            if (Parser::isMobile()) {
                $user_device->is_mobile = true;
            } else if (Parser::isTablet()) {
                $user_device->is_tablet = true;
            } else if (Parser::isDesktop()) {
                $user_device->is_desktop = true;
            } else if (Parser::is_bot()) {
                $user_device->is_bot = true;
            }
            $user_device->save();
        }

        if ($last_sms === null) {
            return redirect()->route('login.enter.verify.code')->with('error', 'Код не верный!');
        } else {
            if ($last_sms->code == $request->get('code')) {
                $last_sms->update([
                    'used' => true,
                ]);
                $user_device->sms_verified = true;
                $user_device->save();

                $user->phone_verified = true;
                $user->save();

                return redirect()->route('accountPanel.dashboard');
            }
        }
        return redirect()->route('login.enter.verify.code')->with('error', 'Код не верный!');
    }
}
