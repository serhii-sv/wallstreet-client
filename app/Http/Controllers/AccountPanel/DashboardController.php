<?php

namespace App\Http\Controllers\AccountPanel;

use App\Http\Controllers\Controller;
use App\Models\Deposit;
use App\Models\Transaction;
use App\Models\TransactionType;
use App\Models\User;
use App\Models\Wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user();
        $wallets = Wallet::where('user_id', $user->id)->get();
        
        return view('accountPanel.dashboard',[
            'wallets' => $wallets,
            'deposits' => Deposit::where('user_id', $user->id)->orderByDesc('created_at')->paginate(5)
        ]);
    }
    
    public function sendMoney(Request $request) {
        $request->validate([
            'user' => 'required',
            'amount' => 'required',
            'wallet_id' => 'required|uuid',
        ]);
        $request_user = $request->get('user');
        $user = Auth::user();
        $recipient_user = User::where('login', $request_user)->orWhere('email', $request_user)->first();
        if ($user === $recipient_user){
            return back()->with('short_error', 'Нельзя переводить самому себе!');
        }
        $amount = abs($request->get('amount'));
        $wallet = Wallet::where('user_id', $user->id)->where('id', $request->get('wallet_id'))->firstOrFail();
        if ($wallet->balance < $amount){
            return back()->with('short_error', 'Недостаточно средств!');
        }
    
        $recipient_user_wallet = Wallet::where('user_id', $recipient_user->id)->where('currency_id', $wallet->currency_id)->first();
        if (empty($recipient_user_wallet)){
            return back()->with('short_error', 'У пользователя нет кошелька с указанной валютой!');
        }
      
        $commission = TransactionType::getByName('transfer_out')->commission;
        DB::beginTransaction();
        try{
            $recipient_user_wallet->update(['balance' => $recipient_user_wallet->balance + $amount - $amount * $commission * 0.01]);
            $wallet->update(['balance' => $wallet->balance - $amount - $amount * $commission * 0.01]);
            
            if (Transaction::transferMoney($wallet, $amount,$user, $recipient_user)){
                DB::commit();
                return back()->with('short_success', 'Средства успешно переведены пользователю ' . $recipient_user->name .'!');
            }else{
                throw new \Exception('Не удалось создать перевод');
            }
        }catch (\Exception $exception){
            DB::rollBack();
            return back()->with('short_error', 'Ошибка! '. $exception->getMessage());
        }
    }
}
