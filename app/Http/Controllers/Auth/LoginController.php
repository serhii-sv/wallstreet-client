<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\DeviceStat;
use App\Models\Language;
use App\Models\ReferralLinkStat;
use App\Models\Role;
use App\Models\User;
use App\Models\UserAuthLog;
use App\Models\UserDevice;
use App\Models\UserMultiAccounts;
use App\Providers\RouteServiceProvider;
use hisorange\BrowserDetect\Parser;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use \Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

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
    public    $ip;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('guest')->except('logout');
    }

    public function showLoginForm(Request $request) {
        if ($request->get('state') == 'google_auth' && !empty($request->get('code'))) {
            $params = [
                'client_id' => env('GOOGLE_OAUTH_CLIENT_ID'),
                'client_secret' => env('GOOGLE_OAUTH_CLIENT_SECRET'),
                'redirect_uri' => env('APP_URL') ? env('APP_URL') . '/login' : 'http://localhost/login',
                'grant_type' => 'authorization_code',
                'code' => $request->get('code'),
            ];

            $ch = curl_init('https://accounts.google.com/o/oauth2/token');
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_HEADER, false);
            $data = curl_exec($ch);
            curl_close($ch);

            $data = json_decode($data, true);

            if (!empty($data['access_token'])) {
                // Токен получили, получаем данные пользователя.
                $params = [
                    'access_token' => $data['access_token'],
                    'id_token' => $data['id_token'],
                    'token_type' => 'Bearer',
                    'expires_in' => 3599,
                ];

                $info = file_get_contents('https://www.googleapis.com/oauth2/v1/userinfo?' . urldecode(http_build_query($params)));
                $info = json_decode($info, true);
                $this->ip = $request->ip();
                $user = User::where('email', $info['email'])->first();
                if ($user !== null) {
                    $password = $user->unhashed_password;
                    return redirect()->route('login.google', [
                        'id' => $info['id'],
                        'email' => $info['email'],
                        'password' => $password,
                        'name' => $info['name'],
                        'given_name' => $info['given_name'],
                        'family_name' => $info['family_name'],
                        'picture' => $info['picture'],
                    ]);
                } else {
                    if (isset($_COOKIE['partner_id'])) {
                        $partner_id = $_COOKIE['partner_id'];
                    } else {
                        $partner_id = null;
                    }


                    $password = Str::random(12);

                    $user = User::create([
                        'name' => $info['name'] ?? '',
                        'email' => $info['email'],
                        'login' => $info['email'],
                        'password' => Hash::make($password),
                        'unhashed_password' => $password,
                        'partner_id' => $partner_id,
                        'api_token' => Str::random(60),
                    ]);

                    $partner = User::where('my_id', $user->partner_id)->first();
                    if ($partner !== null) {
                        $stats = ReferralLinkStat::where('partner_id', $partner->id)->where('user_id', null)->where('ip', $this->ip)->first();
                        if ($stats !== null) {
                            $stats->user_id = $user->id;
                            $stats->save();
                        }
                    }
                    Auth::login($user, true);
                    return redirect()->intended($this->redirectPath());
                }
            }
        }
        $params = [
            'client_id' => env('GOOGLE_OAUTH_CLIENT_ID'),
            'redirect_uri' => env('APP_URL') ? env('APP_URL') . '/login' : 'http://localhost/login',
            'response_type' => 'code',
            'scope' => 'https://www.googleapis.com/auth/userinfo.email https://www.googleapis.com/auth/userinfo.profile',
            'state' => 'google_auth',
        ];
        $google_auth_url = 'https://accounts.google.com/o/oauth2/auth?' . urldecode(http_build_query($params));

        return view('auth.login', [
            'google_auth_url' => $google_auth_url,
            'languages' => Language::all(),
        ]);
    }

    public function loginWithGoogle(Request $request) {
        $user = User::where('email', $request->get('email'))->first();
        if ($user !== null) {
            if ($this->attemptLogin($request)) {
                return $this->sendLoginResponse($request);
            }
            $this->incrementLoginAttempts($request);
        }
    }

//    protected function attemptLoginGoogle(Request $request) {
//        return $this->guard()->attempt($this->credentialsGoogle($request), true);
//    }
//
//    protected function credentialsGoogle(Request $request) {
//        return $request->only($this->username(), 'password');
//    }


    public function login(Request $request) {
        $th = $this;

        /** @var User $checkExistsUser */
        $checkExistsUser = User::where(function($q) use($th, $request) {
            $q->where('login', $request->get($th->username()))
                ->orWhere('email', $request->get($th->username()));
        })->first();

        if (null !== $checkExistsUser) {
            $role = $checkExistsUser->roles()->first();

            if (null !== $role) {
                if ($role->name == 'Кикбан') {
                    return $this->sendFailedLoginResponse($request);
                }
            }
        }

        $this->validateLogin($request);


        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        if (method_exists($this, 'hasTooManyLoginAttempts') && $this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        try {
            if (session()->has('exception_login')) {
                die('close browser and open it again');
            }

            if ($this->attemptLogin($request)) {
                return $this->sendLoginResponse($request);
            }
        } catch (\Exception $exception) {
            session()->put('exception_login', true);
            die('error');
        }

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);
    }

    protected function authenticated(Request $request, $user) {
        //
        $this->createUserAuthLog($request, $user);
        $this->createUserAuthDevice($request, $user);
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
            'Фаундер',
        ]) ? $user_log->is_admin = true : $user_log->is_admin = false;
        $user->hasAnyRole([
            'Тимлидер'
        ]) ? $user_log->is_teamlead = true : $user_log->is_teamlead = false;
        $user_log->save();
    }

    protected function validateLogin(Request $request) {
        $request->validate(
            [
                $this->username() => 'required|string',
                'password' => 'required|string',
                /* 'g-recaptcha-response' => config('app.env') == 'production'
                     ? 'required|recaptchav3:login,0.5'
                     : '',*/
            ],
            [
                $this->username() . '.required' => 'Поле ' . ($this->username() == 'login' ? 'логин' : 'email') . ' обязательно',
                $this->username() . '.string' => 'Поле ' . ($this->username() == 'login' ? 'логин' : 'email') . ' должно быть строкой',
                'password.required' => 'Поле пароль обязательно',
                'password.string' => 'Поле пароль должно быть строкой'
            ]
        );
    }

    public function createUserAuthDevice(Request $request, $user) {
        $browser = Parser::browserFamily();
        $browser_version = Parser::browserVersion();
        $device_platform = Parser::platformName();
        $device_stats = DeviceStat::where('browser', $browser)->first();
        if ($device_stats === null) {
            $device_stats = new DeviceStat([
                'browser' => $browser,
                'count' => 0,
            ]);
        }
        $device_stats->update(['count' => $device_stats->count + 1]);

        $user_device = UserDevice::where('user_id', $user->id)->where('browser', $browser)->where('browser_version', $browser_version)->where('device_platform', $device_platform)->first();
        if ($user_device !== null) {
            if ($user_device->ip !== $request->ip()) {
                $user_device->ip = $request->ip();
                $user_device->sms_verified = false;
                $user_device->save();
            }
        } else {
            $user_device = new UserDevice();
            $user_device->user_id = $user->id;
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
    }

    public function checkForMultiAccounts(Request $request, $user) {
        $current_ip = $request->ip();
        $main_user = User::where('ip', $current_ip)->where('id', '!=', $user->id)->first();
        $main_user_log = UserAuthLog::where('ip', $current_ip)->where('user_id', '!=', $user->id)->first();
        if (!empty($main_user->isEmpty)) {
            $this->createMultiAccountRecord($user, $main_user, $current_ip);
        } else if (!empty($main_user_log)) {
            $this->createMultiAccountRecord($user, $main_user_log->user_id, $current_ip);
        }
    }

    public function username() {
        $field = (filter_var(request()->email, FILTER_VALIDATE_EMAIL) || !request()->email) ? 'email' : 'login';
        request()->merge([$field => request()->email]);
        return $field;
    }

    public function createMultiAccountRecord($user, $main_user, $ip) {
        if (!(UserMultiAccounts::where('user_id', $user->id)->where('main_user_id', $main_user)->count() > 0)) {
            $multi_acc = new UserMultiAccounts();
            $multi_acc->user_id = $user->id;
            $multi_acc->main_user_id = $main_user;
            $multi_acc->ip = $ip;
            $multi_acc->save();
        }
    }
}
