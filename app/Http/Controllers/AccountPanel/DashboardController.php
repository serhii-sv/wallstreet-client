<?php

namespace App\Http\Controllers\AccountPanel;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $wallets = Wallet::where('user_id', Auth::user()->id)->get();
        
        return view('accountPanel.dashboard',[
            'wallets' => $wallets,
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
        $to_user = User::where('login', $request_user)->orWhere('email', $request_user)->first();
        if ($user === $to_user){
            return back()->with('short_error', 'Нельзя переводить самому себе!');
        }
        $amount = abs($request->get('amount'));
        $wallet = Wallet::where('user_id', $user->id)->where('id', $request->get('wallet_id'))->firstOrFail();
        if ($wallet->balance < $amount){
            return back()->with('short_error', 'Недостаточно средств!');
        }
    
        $to_user_wallet = Wallet::where('user_id', $to_user->id)->where('currency_id', $wallet->currency_id)->firstOrFail();
 
       // $wallet->removeAmount($amount);
        dd($to_user_wallet);
        dd($wallet);
        
        return back()->with('short_success', 'Средства успешно переведены пользователю ' . $to_user->name .'!');
    }
}
