<?php

namespace App\Http\Controllers\AccountPanel;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\CloudFile;
use App\Models\Referral;
use App\Models\ReferralLinkStat;
use App\Models\TransactionType;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ReferralsController extends Controller
{

    public function index() {
        /** @var User $user */
        $user = Auth::user();

        /** @var User $upliner */
        $upliner = auth()->user()->partner()->first();

        if ($upliner === null) {
            $upliner = false;
        }

        $all_referrals = $user->referrals()->distinct('id')->with('deposits')->get();
        $transaction_type_invest = TransactionType::where('name', 'create_dep')->first();
        $total_referral_invested = 0;
        foreach ($all_referrals as $referral) {
            $total_referral_invested += cache()->remember('referrals.total_invested_' . $referral->id, 60, function () use ($referral, $transaction_type_invest) {
                return $referral->transactions->where('type_id', $transaction_type_invest->id)->sum('main_currency_amount');
            });
        }
        $referral_link_clicks = ReferralLinkStat::where('partner_id', $user->id)->sum('click_count');
        $referral_link_registered = $user->referrals()->wherePivot('line', 1)->count();

        $personal_turnover = $user->transactions()
            ->where('type_id', TransactionType::getByName('create_dep')->id)
            ->sum('main_currency_amount');

        return view('accountPanel.referrals.index', [
            'all_referrals' => $all_referrals,
            'total_referral_invested' => $total_referral_invested,
            'user' => $user,
            'upliner' => $upliner,
            'transaction_type_invest' => $transaction_type_invest,
            'personal_turnover' => $personal_turnover,
            'referral_link_registered' => $referral_link_registered,
            'referral_link_clicks' => $referral_link_clicks,
        ]);
    }

    public function banners() {
        $banners = Banner::orderBy('created_at', 'desc')->get();
        return view('accountPanel.referrals.banners', [
            'banners' => $banners,
        ]);
    }

    public function treePage() {
        $user = Auth::user();
        return view('accountPanel.referrals.reftree', [
            'user' => $user,
        ]);
    }

    public function reftree($id = null) {
        if (null == $id) {
            throw new \Exception('reftree id is null');
        }
        $user = User::find($id);
        if (empty($user)) {
            return [];
        }

        return $children['children'][] = $this->getChildrens($user, 7);
    }

    private function getChildrens(User $user, $limit = 3) {
        if ($limit === 0) {
            return [];
        }
        if (empty($user)) {
            return [];
        }

        $referrals = [];
        $referrals['name'] = $user->login;
        if (!$user->hasReferrals()) {
            return $referrals;
        }

        foreach ($user->referrals()->wherePivot('line', 1)->get() as $r) {
            $referral = $this->getChildrens($r, $limit - 1);
            $referrals['children'][] = $referral;
        }
        return $referrals;
    }

    public function getBanner($id) {
        $banner_id = Banner::findOrFail($id)->image;

        $file = CloudFile::findOrFail($banner_id);

        $fileFromStorage = Storage::disk('do_spaces')->get($file->url);

        return response($fileFromStorage, 200, [
            'Content-type' => $file->mime,
        ]);

    }
}
