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
        $referrals = Auth::user()->referrals()->paginate(12);
        return view('accountPanel.referrals.index', [
            'referrals' => $referrals,
            'transaction_type_invest' => TransactionType::where('name', 'create_dep')->first(),
        ]);
    }
}
