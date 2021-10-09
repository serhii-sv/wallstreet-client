<?php

namespace App\Http\Controllers\AccountPanel;

use App\Http\Controllers\Controller;
use App\Models\Referral;
use App\Models\TransactionType;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReferralsController extends Controller
{
    
    public function index() {
        $user = Auth::user();
        $upliner = auth()->user()->partner()->first();
        $referrals = Auth::user()->referrals()->distinct('id')->get();
        $transaction_type_invest = TransactionType::where('name', 'create_dep')->first();
        $transaction_type_revenue = TransactionType::where('name', 'close_dep')->first();
        $total_referral_invested = 0;
        $total_referral_revenue = 0;
        foreach ($referrals as $referral) {
            $total_referral_invested += cache()->remember('referrals.total_invested_'.$referral->id, 60, function () use ($referral, $transaction_type_invest){
                return $referral->transactions->where('type_id', $transaction_type_invest->id)->sum('main_currency_amount');
            });;
            $reff_invested = cache()->remember('referral.invested_'.$referral->id, 60, function () use ($referral){
                return $referral->deposits()->sum('invested');
            });
            $diff = cache()->remember('referral.invested_diff'.$referral->id, 60, function () use ($referral,$reff_invested){
                return $referral->deposits()->sum('balance') - $reff_invested;
            });
            if ($diff > 0){
                $total_referral_revenue += $diff;
            }
        }
        //dump($total_referral_invested);
        //dd($referrals);
        return view('accountPanel.referrals.index', [
            'referrals' => $referrals,
            'total_referral_invested' => $total_referral_invested,
            'user' => $user,
            'upliner' => $upliner,
            'transaction_type_invest' => $transaction_type_invest,
            'total_referral_revenue' => $total_referral_revenue,
        ]);
    }
}
