<?php

namespace App\Http\Controllers;

use App\Models\Deposit;
use App\Models\Rate;
use App\Models\Transaction;
use App\Models\Wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DepositsController extends Controller
{
    //
    public function index() {
        $user_id = auth()->user()->id;
        return view('accountPanel.deposits.index', [
            'deposits' => Deposit::where('user_id', $user_id)->orderByDesc('created_at')->paginate(10),
            'deposits_count' => Deposit::where('user_id', $user_id)->count(),
        ]);
    }
    
    public function create() {
        return view('accountPanel.deposits.create', [
            'rates' => Rate::where('active', true)->orderBy('min', 'asc')->get(),
            'wallets' => Wallet::where('user_id', auth()->user()->id)->get(),
        ]);
    }
    
    public function store(Request $request) {
        $request->validate([
            'rate_id' => 'required|uuid',
            'wallet_id' => 'required|uuid',
            'amount' => 'required',
        ]);
        $amount = abs($request->get('amount'));
        
        $user = isset($data['user']) ? $data['user'] : Auth::user();
        $rate = Rate::findOrFail($request->get('rate_id'));
        $wallet = Wallet::where('user_id', $user->id)->where('id', $request->get('wallet_id'))->firstOrFail();
        
        if ($amount < $rate->min) {
            return redirect()->route('accountPanel.deposits.create')->with('error', 'Сумма депозита меньше, чем минимальная ставка тарифного плана!');
        }
        if ($amount > $rate->max) {
            return redirect()->route('accountPanel.deposits.create')->with('error', 'Сумма депозита больше, чем максимальная ставка тарифного плана!');
        }
        if (abs($amount) > abs($wallet->balance)) {
            return redirect()->route('accountPanel.deposits.create')->with('error', 'Недостаточно средств на балансе!');
        }
        $deposit                    = new Deposit;
        $deposit->rate_id           = $rate->id;
        $deposit->currency_id       = $wallet->currency_id;
        $deposit->wallet_id         = $wallet->id;
        $deposit->user_id           = $user->id;
        $deposit->invested          = $amount;
        $deposit->daily             = $rate->daily;
        $deposit->overall           = $rate->overall;
        $deposit->duration          = $rate->duration;
        $deposit->payout            = $rate->payout;
        $deposit->balance           = $amount;
        $deposit->reinvest          = false;
        $deposit->autoclose         = $rate->autoclose;
        $deposit->condition         = 'create';
        $deposit->datetime_closing  = now()->addDays($rate->duration);
    
        $transaction = $deposit->save()
            ? Transaction::createDeposit($deposit)
            : null;

        if (null != $transaction && $deposit->wallet->removeAmount($amount)) {
            $wallet->accrueToPartner($amount, 'refill');

            $transaction->update(['approved' => true]);
            $deposit->update(['active' => true]);

            // send notification to user
            $data = [
                'deposit' => $deposit
            ];
            //            $deposit->user->sendNotification('deposit_opened', $data);
            if ($deposit->createSequence())
            {
                return back()->with('success', 'Депозит успешно создан!');
            } else {
                return back()->with('error', 'Не удалось создать депозит!');
            }
        }
    }
}
