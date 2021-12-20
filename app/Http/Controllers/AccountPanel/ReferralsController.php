<?php

namespace App\Http\Controllers\AccountPanel;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\CloudFile;
use App\Models\Currency;
use App\Models\Deposit;
use App\Models\Referral;
use App\Models\ReferralLinkStat;
use App\Models\TransactionType;
use App\Models\User;
use App\Models\Wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use function React\Promise\all;

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

        $all_referrals = cache()->remember('referrals.array.' . $user->id, now()->addHours(3), function() use ($user) {
            return $user->getAllReferralsInArray();
        });

        $total_referral_invested = $user->referrals_invested_total;

        $activeReferrals = $user->total_referrals_count;

        $referral_link_clicks = cache()->remember('user.'.$user->id, now()->addHours(3), function() use($user) {
            return ReferralLinkStat::where('partner_id', $user->id)->sum('click_count');
        });

        $referral_link_registered = cache()->remember('referrals_count.'.$user->id, now()->addHours(3), function() use($all_referrals) {
            return count($all_referrals);
        });

        $personal_turnover = $user->personal_turnover;

        return view('accountPanel.referrals.index', [
            'all_referrals' => $all_referrals,
            'activeReferrals' => $activeReferrals,
            'total_referral_invested' => $total_referral_invested,
            'user' => $user,
            'upliner' => $upliner,
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
            throw new \Exception('id реф дерева null');
        }
        $user = User::find($id);
        if (empty($user)) {
            return [];
        }

        return $children['children'][] = cache()->remember('reftree.'.$user->id, now()->addHours(3), function() use ($user) {
            return $this->getChildrens($user, 7);
        });
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
