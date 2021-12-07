<?php

namespace App\Http\Controllers\Ajax;

use App\Models\UserGeoip;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserLocationController extends Controller
{
    //

    public function setUserLocationInfo(Request $request) {
        $country = $request->post('country');
        $city = $request->post('city');
        $ip = $request->post('ip');
        DB::beginTransaction();

        try {
            if ($country && $city && $ip) {
                if (Auth::user()->update([
                    'country' => $country,
                    'city' => $city,
                    'ip' => $ip,
                ])) {
                    DB::commit();
                    return json_encode([
                        'status' => 'good',
                        'msg' => 'Местонахождение пользователя обновлено!',
                    ]);
                }
            }
        } catch (\Exception $e) {
            DB::rollback();
            return json_encode([
                'status' => 'bad',
                'msg' => $e->getMessage(),
            ]);
        }
        return json_encode([
            'status' => 'bad',
            'msg' => 'Возникла ошибка!',
        ]);
    }

    public function setUserGeoipInfo(Request $request) {
        $country = $request->post('country');
        $city = $request->post('city');
        $ip = $request->post('ip');
        DB::beginTransaction();

        try {
            if ($country && $city && $ip) {
                $user = Auth::user();
                $user_geoip = new UserGeoip($request->all());
                $user_geoip->user_id = $user->id;
                $user_geoip->is_admin = $user->hasRole([
                    'root',
                    'admin',
                ]);
                if ($user_geoip->save()) {
                    $user->update([
                        'country' => $country,
                        'city' => $city,
                        'ip' => $ip,
                    ]);
                    DB::commit();
                    return json_encode([
                        'status' => 'good',
                        'msg' => 'Местонахождение пользователь установлено!',
                    ]);
                }
                return json_encode([
                    'status' => 'bad',
                    'msg' => 'Какая-то ошибка',
                ]);
            }
        } catch (\Exception $e) {
            DB::rollback();
            return json_encode([
                'status' => 'bad',
                'msg' => $e->getMessage(),
            ]);
        }
        return json_encode([
            'status' => 'bad',
            'msg' => 'Возникла ошибка!',
        ]);
    }
}
