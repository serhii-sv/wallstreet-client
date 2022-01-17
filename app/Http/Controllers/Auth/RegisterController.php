<?php

namespace App\Http\Controllers\Auth;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Mail\RegistrationNotification;
use App\Models\Language;
use App\Models\Notification;
use App\Models\ReferralLinkStat;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Rules\PhoneNumber;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
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
        $this->middleware('guest');
    }


    public function showRegistrationForm(Request $request)
    {
        $params = array(
            'client_id'     => env('GOOGLE_OAUTH_CLIENT_ID'),
            'redirect_uri'  => env('APP_URL') ? env('APP_URL') . '/login' : 'http://localhost/login',
            'response_type' => 'code',
            'scope'         => 'https://www.googleapis.com/auth/userinfo.email https://www.googleapis.com/auth/userinfo.profile ',
            'state'         => 'google_auth'
        );
        $google_auth_url = 'https://accounts.google.com/o/oauth2/auth?' . urldecode(http_build_query($params));

        return view('auth.register', [
            'google_auth_url' => $google_auth_url,
            'languages' => Language::all(),
        ]);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param array $data
     *
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data) {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'login' => ['required', 'string', 'max:50', 'unique:users,login'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'phone' => ['required', 'min:6', new PhoneNumber()],
        ], [
            'name.required' => 'Поле имя обязательно',
            'name.string' => 'Поле имя должно быть строкой',
            'name.max' => 'Поле имя не должно быть больше чем :max',

            'login.required' => 'Поле логин обязательно',
            'login.string' => 'Поле логин должно быть строкой',
            'login.max' => 'Поле логин не должно быть больше чем :max',
            'login.unique' => 'Логин уже используется',

            'email.required' => 'Поле :attribute обязательно',
            'email.string' => 'Поле :attribute должно быть строкой',
            'email.max' => 'Поле :attribute не должно быть больше чем :max',
            'email.unique' => ':attribute уже используется',

            'password.required' => 'Поле пароль обязательно',
            'password.string' => 'Поле пароль должно быть строкой',
            'password.min' => 'Поле пароль не должно быть меньше чем :min',
            'password.confirmed' => 'Пароль не подтвержден',

            'phone.required' => 'Поле телефон обязательно',
            'phone.min' => 'Поле телефон не должно быть меньше чем :min',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param array $data
     *
     * @return \App\Models\User
     */
    protected function create(array $data) {
        if (isset($data['partner_id'])) {
            $partner_id = (float) $data['partner_id'];
        } else if (isset($_COOKIE['partner_id'])) {
            $partner_id = (float) $_COOKIE['partner_id'];
        } else {
            $partner_id = null;
        }

        /** @var User|null $partner */
        $partner = null !== $partner_id ? User::where('my_id', $partner_id)->first() : (User::where('login', 'sprintbank')->first() ?? null);

        if (null === $partner) {
            $partner = User::where('login', 'sprintbank')->first();
            $partner_id = $partner->my_id;
        }

        if (empty($data['login'])) {
            $data['login'] = $data['email'];
        }

        if ($partner !== null) {

            $notification_data = [
                'notification_name' => 'Новый реферал',
                'user' => $partner,
                'referral' => $data['login'],
            ];

            Notification::sendNotification($notification_data, 'new_referral');
        }

        /** @var User $user */
        return User::create([
            'name' => $data['name'] ?? '',
            'email' => $data['email'],
            'login' => $data['login'],
            'phone' => $data['phone'] ? $data['phone'] : null,
            'password' => Hash::make($data['password']),
            'unhashed_password' => $data['password'],
            'partner_id' => $partner_id,
            'api_token' => Str::random(60),
            'auth_with_phone' => true,
        ]);
    }

    public function register(Request $request) {
        $this->validator($request->all())->validate();
        $this->ip = $request->ip();
        event(new Registered($user = $this->create($request->all())));
        $partner = User::where('my_id', $user->partner_id)->first();
        if ($partner !== null) {
            $stats = ReferralLinkStat::where('partner_id', $partner->id)->where('user_id', null)->where('ip', $this->ip)->first();
            if ($stats !== null) {
                $stats->user_id = $user->id;
                $stats->save();
            }
        }

        $this->guard()->login($user);

//        Mail::to($user)->send(new RegistrationNotification($user));

        if ($response = $this->registered($request, $user)) {
            return $response;
        }

        return $request->wantsJson() ? new JsonResponse([], 201) : redirect($this->redirectPath());
    }
}
