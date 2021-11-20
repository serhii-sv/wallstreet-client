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

        $all_referrals = cache()->remember('referrals.array.'.$user->id, now()->addMinutes(60), function() use($user) {
            return $user->getAllReferralsInArray();
        });
        $activeReferrals = 0;
        $total_referral_invested = 0;
        $usdCurrency = Currency::where('code', 'USD')->first();

        /** @var User $referral */
        foreach ($all_referrals as $referral) {
            $total_referral_invested += cache()->remember('referrals.total_invested_' . $referral->id, now()->addMinutes(60), function () use ($referral, $usdCurrency) {
                $invested = 0;
                $referral
                    ->deposits()
                    ->where('active', 1)
                    ->get()
                    ->each(function(Deposit $deposit) use(&$invested, $usdCurrency) {
                        $invested += (new Wallet())->convertToCurrency($deposit->currency, $usdCurrency, $deposit->balance);
                    });

                return $invested;
            });

            $activeReferrals += $referral->deposits()
                    ->where('active', 1)
                    ->count() > 0 ? 1 : 0;
        }
        $referral_link_clicks = ReferralLinkStat::where('partner_id', $user->id)->sum('click_count');
        $referral_link_registered = count($all_referrals);

        $personal_turnover = 0;
        $user->deposits()
            ->where('active', 1)
            ->get()
            ->each(function(Deposit $deposit) use(&$personal_turnover, $usdCurrency) {
                $personal_turnover += (new Wallet())->convertToCurrency($deposit->currency, $usdCurrency, $deposit->balance);
            });

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
