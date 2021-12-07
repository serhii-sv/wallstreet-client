<?php

namespace App\Http\Controllers;

use App\Models\ReferralLinkStat;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SetPartnerController extends Controller
{
    /**
     * @param $partner_id
     *
     * @return $this|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Exception
     */
    public function index(Request $request, $partner_id) {
        $check['partner_id'] = trim($partner_id);

        $validator = Validator::make($check, [
            'partner_id' => 'required|exists:users,my_id',
        ], [
            'partner_id.required' => 'Поле :attribute обязательно',
            'partner_id.uuid' => 'Выбранный :attribute является недействительным.',
        ]);

        if ($validator->fails()) {
            return redirect('/')->withErrors($validator);
        }
        $partner = User::where('my_id', $partner_id)->first();

        if (null !== $partner) {
            $stats = ReferralLinkStat::where('partner_id', $partner->id)->where('user_id', null)->where('ip', $request->ip())->first();
            if ($stats === null) {
                $stats = new ReferralLinkStat();
                $stats->partner_id = $partner->id;
                $stats->ip = $request->ip();
            } else {
                $stats->click_count++;
            }
            $stats->save();
            setcookie("partner_id", $partner_id, time() + 2592000, '/'); // expire in 30 days
        }

        return redirect(route('register'));
    }
}
