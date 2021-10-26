<?php

namespace App\Http\Controllers\AccountPanel;

use App\Http\Controllers\Controller;
use App\Models\Currency;
use App\Models\ExchangeRateLog;
use App\Models\Setting;
use App\Models\Transaction;
use App\Models\Wallet;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CurrencyController extends Controller
{
    //
    
    public function showCurrencyExchange() {
        $sprint_rate = Setting::where('s_key', 'sprint_to_usd')->first();
        if ($sprint_rate !== null) {
            $exchange_rate_log = ExchangeRateLog::where('rate_id', $sprint_rate->id)->orderByDesc('date')->limit(40)->get();
            $exchange_rate_log = $exchange_rate_log->sortBy('date');
        } else {
            $exchange_rate_log = false;
        }
     
        return view('accountPanel.currency.exchange', [
            'exchange_rate_log' => $exchange_rate_log,
            'wallets' => Wallet::where('user_id', Auth::user()->id)->get(),
        ]);
    }
    
    public function currencyExchange(Request $request) {
        $request->validate([
            'amount' => 'required',
            'wallet_from' => 'required',
            'wallet_to' => 'required',
        ]);
        if ($request->get('wallet_from') == $request->get('wallet_to')){
            return redirect()->back()->with('error', 'Кошельки должны отличаться!');
        }
        $amount = abs($request->get('amount'));
        $commission = 1;
        $wallet_from = Wallet::where('user_id', Auth::user()->id)->where('id', $request->get('wallet_from'))->first();
        $wallet_to = Wallet::where('user_id', Auth::user()->id)->where('id', $request->get('wallet_to'))->first();
        
        //  $balance = $wallet_from->convertToCurrency($wallet->currency()->first(), $toCurrency, abs($wallet->balance));
        if ($amount > $wallet_from->balance) {
            return redirect()->back()->with('error', 'Недостаточно средств на балансе!');
        }
        DB::beginTransaction();
        try {
            if ($wallet_from->exchangeCurrency($wallet_from, $wallet_to, $amount, $commission)) {
                DB::commit();
                return redirect()->back()->with('success', 'Обмен успешно произведён!');
            }else{
                return back()->with('error', 'Ошибка! Не получилось обменять');
            }
        } catch (\Exception $exception) {
            DB::rollBack();
            return back()->with('error', 'Ошибка! ' . $exception->getMessage());
        }
        
        
        //        $transaction = $deposit->save()
        //            ? Transaction::exchangeCurrency($wallet_from, $balance)
        //            : null;
        //return redirect()->back()->with('success', 'Обмен успешно произведён!');
    }
}
