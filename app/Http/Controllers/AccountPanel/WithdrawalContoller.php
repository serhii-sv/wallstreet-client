<?php

namespace App\Http\Controllers\AccountPanel;

use App\Http\Controllers\Controller;
use App\Models\PaymentSystem;
use App\Models\Transaction;
use App\Models\Wallet;
use Illuminate\Http\Request;

class WithdrawalContoller extends Controller
{
    //
    
    public function index() {
        
        return view('accountPanel.withdrawal.index',[
            'wallets' => Wallet::where('user_id',auth()->user()->id)->get(),
            'payment_systems' => PaymentSystem::all(),
        ]);
    }
    
    public function addWithdrawal(Request $request) {
        $request->validate([
           'payment_system' => 'required|uuid',
           'amount' => 'required',
           'wallet_id' => 'required|uuid',
        ]);
        $amount = $request->get('amount');
        $wallet = Wallet::where('id',$request->get('wallet_id'))->where('user_id', auth()->user()->id)->first();
        if (empty($wallet)){
            return back()->with('error', 'Кошелька не существует!');
        }
//        if ($wallet->payment_system_id != $request->get('payment_system')){
//            return back()->with('error', 'Платёжная система не доступна для этой операции!');
//        }
        if ($wallet->balance >= $amount)
        {
            $transaction = Transaction::withdraw($wallet, $amount);
            if (null !== $transaction) {
                $transaction->approved = 0;
                $transaction->save();
                return back()->with('success', 'Заявка на вывод зарегестрирована!');
            }
            return back()->with('error','Не удалось создать транзакцию!');
        }
        return back()->with('error','Недостаточно средств на счёте для выполнения данной операции!');
    }
}
