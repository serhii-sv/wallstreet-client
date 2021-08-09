<?php

namespace App\Http\Controllers\Ajax;

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
                        'msg' => 'User location updated!',
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
            'msg' => 'Some problems!',
        ]);
    }
}
