<?php

namespace App\Http\Controllers\AccountPanel;

use App\Http\Controllers\Controller;
use App\Models\Currency;
use App\Models\Notification;
use App\Models\PaymentSystem;
use App\Models\Transaction;
use App\Models\TransactionType;
use App\Models\UserWalletDetail;
use App\Models\Wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WithdrawalContoller extends Controller
{
    //
    
    public function index() {
        $currencies = Currency::all();
        return view('accountPanel.withdrawal.index', [
            'wallets' => Wallet::where('user_id', auth()->user()->id)->with('currency')->where('currency_id', '!=', Currency::where('code', 'SPRINT')->first()->id)->get(),
            'payment_systems' => PaymentSystem::all(),
            'currencies' => $currencies,
        ]);
    }
    /*public function addWithdrawal(Request $request) {
        $request->validate([
            'amount' => 'required',
            'wallet_id' => 'required|uuid',
            'payment_system_id' => 'required|uuid',
        ]);
        $wallet = Wallet::where('id', $request->get('wallet_id'))->where('user_id', auth()->user()->id)->first();
        if (empty($wallet)) {
            return redirect()->back()->with('error', 'Кошелька не существует!');
        }
        $payment_system = PaymentSystem::where('id', $request->get('payment_system_id'))->first();
        if ($payment_system == null) {
            return redirect()->back()->with('error', 'Платёжная система не доступна!');
        }
        
        $wallet_detail = UserWalletDetail::where('payment_system_id', $payment_system->id)->where('wallet_id', $wallet->id)->first();
        if ($wallet_detail == null) {
            return redirect()->back()->with('error', 'Введите реквизиты для этой платёжной системы в настройках!');
        }
        $amount = (float)abs($request->get('amount'));
        if (!($amount > 0)) {
            return redirect()->back()->with('error', 'Сумма должна быть больше 0!');
        }
        
        $type = TransactionType::getByName('withdraw');
        $commission = $type->commission;
        $commission_usd = $type->commission_usd;
        $amountWithCommission = $amount / ((100 - $commission) * 0.01);
        $toCurrency = Currency::where('code', 'USD')->first();
        $amount_in_usd = Wallet::convertToCurrencyStatic($wallet->currency, $toCurrency, $amountWithCommission);
        $amountWithCommission = Wallet::convertToCurrencyStatic($toCurrency, $wallet->currency, $amount_in_usd + $commission_usd);
        
        if ($amountWithCommission > $wallet->balance) {
            return redirect()->back()->with('error', 'Amount is more than you can withdraw!');
        }
        
        if ($wallet->balance >= $amount) {
            $transaction = Transaction::withdraw($wallet, $amount, $payment_system);
            if (null !== $transaction) {
                $transaction->approved = 0;
                $transaction->save();
                $notification_data = [
                    'notification_name' => 'Вывод средств',
                    'amount' => $amount . $wallet->currency->symbol,
                    'amountWithCommission' => $amountWithCommission . $wallet->currency->symbol,
                    'user' => Auth::user(),
                    'to_user' => Auth::user(),
                ];
                Notification::sendNotification($notification_data, 'new_withdrawal');
                return redirect()->back()->with('success', 'Заявка на вывод создана! В течение 72ч ваша заявка будет обработана!');
            }
            return redirect()->back()->with('error', 'Не удалось создать транзакцию!');
        }
        return back()->with('error', 'Недостаточно средств на счёте для выполнения данной операции!');
    }*/
    
    public function addWithdrawal(Request $request) {
        $request->validate([
            'amount' => 'required',
            'wallet_id' => 'required|uuid',
            'wallet_detail' => 'required|uuid',
        ]);
        $wallet = Wallet::where('id', $request->get('wallet_id'))->where('user_id', auth()->user()->id)->first();
        if (empty($wallet)) {
            return redirect()->back()->with('error', 'Кошелька не существует!');
        }
        $amount = (float)abs($request->get('amount'));
        if (!($amount > 0)) {
            return redirect()->back()->with('error', 'Сумма должна быть больше 0!');
        }
        $payment_system = PaymentSystem::find($wallet_detail->payment_system_id);
        if ($payment_system == null) {
            return redirect()->back()->with('error', 'Платёжная система не доступна!');
        }
        
        $type = TransactionType::getByName('withdraw');
        $commission = $type->commission;
        $commission_usd = $type->commission_usd;
        $amountWithCommission = $amount / ((100 - $commission) * 0.01);
        $toCurrency = Currency::where('code', 'USD')->first();
        $amount_in_usd = Wallet::convertToCurrencyStatic($wallet->currency, $toCurrency, $amountWithCommission);
        $amountWithCommission = Wallet::convertToCurrencyStatic($toCurrency, $wallet->currency, $amount_in_usd + $commission_usd);
        
        if ($amountWithCommission > $wallet->balance) {
            return redirect()->back()->with('error', 'Amount is more than you can withdraw!');
        }
        
        if ($wallet->balance >= $amount) {
            $transaction = Transaction::withdraw($wallet, $amount, $payment_system);
            if (null !== $transaction) {
                $transaction->approved = 0;
                $transaction->save();
                $notification_data = [
                    'notification_name' => 'Вывод средств',
                    'amount' => $amount . $wallet->currency->symbol,
                    'amountWithCommission' => $amountWithCommission . $wallet->currency->symbol,
                    'user' => Auth::user(),
                    'to_user' => Auth::user(),
                ];
                Notification::sendNotification($notification_data, 'new_withdrawal');
                return redirect()->back()->with('success', 'Заявка на вывод зарегестрирована!');
            }
            return redirect()->back()->with('error', 'Не удалось создать транзакцию!');
        }
        return back()->with('error', 'Недостаточно средств на счёте для выполнения данной операции!');
    }
}
