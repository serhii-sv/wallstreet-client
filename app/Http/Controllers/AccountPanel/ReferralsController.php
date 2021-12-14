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


        return view('accountPanel.referrals.index');
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
