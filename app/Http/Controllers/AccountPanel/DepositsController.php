<?php

namespace App\Http\Controllers\AccountPanel;

use App\Http\Controllers\Controller;
use App\Models\Currency;
use App\Models\Deposit;
use App\Models\Rate;
use App\Models\RateGroup;
use App\Models\Transaction;
use App\Models\Wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DepositsController extends Controller
{
    public function index() {
        $user_id = auth()->user()->id;
        $deposits = Deposit::where('user_id', $user_id)->with('rate','currency')->orderByDesc('created_at')->paginate(10);
        $deposit_groups = RateGroup::all();
        return view('accountPanel.deposits.index', [
            'deposits' => $deposits,
            'deposit_groups' => $deposit_groups,
            'deposits_count' => Deposit::where('user_id', $user_id)->count(),
        ]);
    }
    
    public function create() {
        $user = auth()->user();
        $deposit_groups = RateGroup::all();
        $deposits = Deposit::where('user_id', $user->id)->where('active', 'true')->with('rate','currency')->get();
        return view('accountPanel.deposits.create', [
            'deposit_groups' => $deposit_groups,
            'deposits' => $deposits,
            'rates' => Rate::where('active', true)->orderBy('min', 'asc')->get(),
            'wallets' => Wallet::where('user_id', $user->id)->get(),
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
        $rate = Rate::where('id',$request->get('rate_id'))->where('active', true)->first();
        if ($rate === null){
            return redirect()->back()->with('error', 'Тарифный план не доступен!');
        }
        $wallet = Wallet::where('user_id', $user->id)->where('id', $request->get('wallet_id'))->first();
        if ($wallet === null){
            return redirect()->back()->with('error', 'Кошелька не существует!');
        }
        $main_currency = Currency::where('code', 'USD')->first();
        $currency = Currency::where('id', $wallet->currency_id)->first();
        $deposit = Deposit::where('rate_id', $rate->id)->where('active', true)->where('user_id', Auth::user()->id)->where('wallet_id', $wallet->id)->first();
        $rate_min = Wallet::convertToCurrencyStatic($main_currency,$currency, $rate->min);
        $rate_max = Wallet::convertToCurrencyStatic($main_currency,$currency, $rate->max);
  /*      dump($rate_min);
        dd($rate_max);*/
        if ($deposit !== null){
            return redirect()->back()->with('error', 'По одному тарифному плану можно сделать только один депозит с одного кошелька!');
        }
        if ($amount < $rate_min) {
            return redirect()->route('accountPanel.deposits.create')->with('error', 'Сумма депозита меньше, чем минимальная ставка тарифного плана - '. $rate_min . '!');
        }
        if ($amount > $rate_max) {
            return redirect()->route('accountPanel.deposits.create')->with('error', 'Сумма депозита больше, чем максимальная ставка тарифного плана - '. $rate_max . '!');
        }
        $balance = abs($wallet->balance);
        if (abs($amount) > $balance) {
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
