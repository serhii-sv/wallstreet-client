<?php

namespace App\Http\Controllers\AccountPanel;

use App\Http\Controllers\Controller;
use App\Models\Deposit;
use App\Models\Transaction;
use App\Models\TransactionType;
use App\Models\User;
use App\Models\Wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth');
    }
    
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index() {
        $user = Auth::user();
        $wallets = Wallet::where('user_id', $user->id)->get();
        $withdraw_type = TransactionType::where('name', 'withdraw')->first();
        $partner_type = TransactionType::where('name', 'partner')->first();
        $dividend_type = TransactionType::where('name', 'dividend')->first();
        $accruals_ids=[];
        array_push($accruals_ids, $partner_type->id, $dividend_type->id);
        $period_graph = $this->getPeriodDays(14);
        $withdraws_2week = [];
        $accruals_2week = [];
        
        
        foreach ($period_graph as $period) {
            $accruals_2week[$period['start']->format('d.m.Y')] = cache()->remember('accruals_2weeks_' . $period['start']->format('d.m.Y'), 60, function () use ($accruals_ids, $user, $period) {
                return Transaction::where('user_id', $user->id)
                    ->whereIn('type_id', $accruals_ids)
                    ->where('approved', 1)
                    ->whereBetween('created_at', [
                        $period['start'],
                        $period['end'],
                    ])->sum('main_currency_amount');
            });
            $withdraws_2week[$period['start']->format('d.m.Y')] = cache()->remember('withdraws_2week_' . $period['start']->format('d.m.Y'), 60, function () use ($withdraw_type, $user, $period) {
                return Transaction::where('user_id', $user->id)
                    ->where('type_id', $withdraw_type->id)
                    ->where('approved', 1)
                    ->whereBetween('created_at', [
                        $period['start'],
                        $period['end'],
                    ])->sum('main_currency_amount');
            });
        }
        
        return view('accountPanel.dashboard', [
            'wallets' => $wallets,
            'deposits' => Deposit::where('user_id', $user->id)->orderByDesc('created_at')->paginate(5),
            'period_graph' => $period_graph,
            'withdraws_2week' => $withdraws_2week,
            'accruals_2week' => $accruals_2week,
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
        if ($user === $recipient_user) {
            return back()->with('short_error', 'Нельзя переводить самому себе!');
        }
        $amount = abs($request->get('amount'));
        $wallet = Wallet::where('user_id', $user->id)->where('id', $request->get('wallet_id'))->firstOrFail();
        if ($wallet->balance < $amount) {
            return back()->with('short_error', 'Недостаточно средств!');
        }
        
        $recipient_user_wallet = Wallet::where('user_id', $recipient_user->id)->where('currency_id', $wallet->currency_id)->first();
        if (empty($recipient_user_wallet)) {
            return back()->with('short_error', 'У пользователя нет кошелька с указанной валютой!');
        }
        
        $commission = TransactionType::getByName('transfer_out')->commission;
        DB::beginTransaction();
        try {
            $recipient_user_wallet->update(['balance' => $recipient_user_wallet->balance + $amount - $amount * $commission * 0.01]);
            $wallet->update(['balance' => $wallet->balance - $amount - $amount * $commission * 0.01]);
            
            if (Transaction::transferMoney($wallet, $amount, $user, $recipient_user)) {
                DB::commit();
                return back()->with('short_success', 'Средства успешно переведены пользователю ' . $recipient_user->name . '!');
            } else {
                throw new \Exception('Не удалось создать перевод');
            }
        } catch (\Exception $exception) {
            DB::rollBack();
            return back()->with('short_error', 'Ошибка! ' . $exception->getMessage());
        }
    }
    
    public function getPeriodDays($days = 7) {
        $period = [];
        for ($i = 0, $j = $days; $j >= $i; $j--) {
            $period[$j]['start'] = Carbon::now()->startOfDay()->subDay($j);
            if (Carbon::now() < Carbon::now()->endOfDay()->subDay($j)) {
                $period[$j]['end'] = Carbon::now();
            } else {
                $period[$j]['end'] = Carbon::now()->endOfDay()->subDay($j);
            }
            
        }
        return $period;
    }
}
