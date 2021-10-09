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
        //$referral->transactions->where('type_id', $transaction_type_invest->id)->sum('main_currency_amount'), 2, '.', ' ');
        dd($referrals);
        return view('accountPanel.referrals.index', [
            //'referrals' => $referrals,
            'user' => $user,
            'upliner' => $upliner,
            'transaction_type_invest' => $transaction_type_invest,
        ]);
    }
}
