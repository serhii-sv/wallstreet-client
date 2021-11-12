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
        return redirect()->route('accountPanel.deposits.create');
        /*$user_id = auth()->user()->id;
        $deposits = Deposit::where('user_id', $user_id)->with('rate', 'currency', 'wallet')->orderByDesc('created_at')->paginate(12);
        $deposit_groups = RateGroup::all();
        return view('accountPanel.deposits.index', [
            'deposits' => $deposits,
            'deposit_groups' => $deposit_groups,
            'deposits_count' => Deposit::where('user_id', $user_id)->count(),
        ]);*/
    }

    public function create() {
        $user = auth()->user();
        $deposit_groups = RateGroup::all();
        $deposits = Deposit::where('user_id', $user->id)->where('active', true)->orderByDesc('created_at')->with('rate', 'currency', 'wallet')->paginate(12);
        $rates = Rate::where('active', true)->orderBy('min', 'asc')->get();

        return view('accountPanel.deposits.create', [
            'deposit_groups' => $deposit_groups,
            'deposits' => $deposits,
            'rates' => $rates,
            'wallets' => Wallet::where('user_id', $user->id)->get(),
        ]);
    }

    public function getRateMinMax(Request $request) {
        if ($request->ajax()) {
            $rate_id = $request->get('rate_id');
            $currency_id = $request->get('currency_id');
            $rate = Rate::find($rate_id);
            $currency = Currency::find($currency_id);
            if ($rate === null){
                return json_encode([
                    'rate_min_max' => '0',
                ]);
            }
            if ($currency === null){
                return json_encode([
                    'rate_min_max' => '0',
                ]);
            }
            $currency_usd = Currency::where('code', 'USD')->first();
            if ($currency_usd === null){
                return json_encode([
                    'rate_min_max' => '<h5 class="sub-title">'.__('Min '.$rate_id).' ' .  number_format($rate->min, 2,'.',',') .'$</h5>
                                    <h5 class="sub-title">'.__('Max '.$rate_id).' ' . number_format($rate->max, 2,'.',' ') .'$</h5>',
                ]);
            }

            $min = Wallet::convertToCurrencyStatic($currency_usd, $currency, $rate->min);
            $max = Wallet::convertToCurrencyStatic($currency_usd, $currency, $rate->max);

            return json_encode([
                'rate_min_max' => '<h5 class="sub-title">'.__('Min '.$rate_id).' ' . number_format($min, $currency->precision, '.', ',') . ' '. $currency->symbol . '</h5>
                <h5 class="sub-title">'.__('Min '.$rate_id).' ' . number_format($max, $currency->precision, '.', ' ') . ' '. $currency->symbol . '</h5 >',
            ]);
        }
        return json_encode([
            'rate_min_max' => '0',
        ]);
    }

    public function store(Request $request) {
        $request->validate([
            'rate_id' => 'required | uuid',
            'wallet_id' => 'required | uuid',
            'amount' => 'required',
        ]);

        $amount = abs(doubleval(str_replace(',', ' . ', $request->get('amount'))));

        $user = isset($data['user']) ? $data['user'] : Auth::user();
        $rate = Rate::where('id', $request->get('rate_id'))->where('active', true)->first();
        if ($rate === null) {
            return redirect()->back()->with('error', 'Тарифный план не доступен!');
        }
        $reinvest = 0;
        $wallet = Wallet::where('user_id', $user->id)->where('id', $request->get('wallet_id'))->first();
        if ($wallet === null) {
            return redirect()->back()->with('error', 'Кошелька не существует!');
        }
        $main_currency = Currency::where('code', 'USD')->first();
        $currency = Currency::where('id', $wallet->currency_id)->first();
        $deposit = Deposit::where('rate_id', $rate->id)->where('active', true)->where('user_id', Auth::user()->id)->where('wallet_id', $wallet->id)->first();
        $rate_min = Wallet::convertToCurrencyStatic($main_currency, $currency, $rate->min);
        $rate_max = Wallet::convertToCurrencyStatic($main_currency, $currency, $rate->max);

        if ($deposit !== null) {
            return redirect()->back()->with('error', 'По одному тарифному плану можно сделать только один депозит с одного кошелька!');
        }
        if ($amount < $rate_min) {
            return redirect()->route('accountPanel.deposits.create')->with('error', 'Сумма депозита меньше, чем минимальная ставка тарифного плана - ' . $rate_min . '!');
        }
        if ($amount > $rate_max) {
            return redirect()->route('accountPanel.deposits.create')->with('error', 'Сумма депозита больше, чем максимальная ставка тарифного плана - ' . $rate_max . '!');
        }
        $balance = abs($wallet->balance);
        if (abs($amount) > $balance) {
            return redirect()->route('accountPanel.deposits.create')->with('error', 'Недостаточно средств на балансе!');
        }
        $deposit = new Deposit;
        $deposit->rate_id = $rate->id;
        $deposit->currency_id = $wallet->currency_id;
        $deposit->wallet_id = $wallet->id;
        $deposit->user_id = $user->id;
        $deposit->invested = $amount;
        $deposit->daily = $rate->daily;
        $deposit->overall = $rate->overall;
        $deposit->duration = $rate->duration;
        $deposit->payout = $rate->payout;
        $deposit->balance = $amount;
        $deposit->reinvest = $reinvest;
        $deposit->autoclose = $rate->autoclose;
        $deposit->condition = 'create';
        $deposit->datetime_closing = now()->addDays($rate->duration);

        $transaction = $deposit->save() ? Transaction::createDeposit($deposit) : null;

        if (null != $transaction && $deposit->wallet->removeAmount($amount)) {
            $wallet->accrueToPartner($amount, 'refill');

            $transaction->update(['approved' => true]);
            $deposit->update(['active' => true]);

            // send notification to user
            $data = [
                'deposit' => $deposit,
            ];
            //            $deposit->user->sendNotification('deposit_opened', $data);
            if ($deposit->createSequence()) {
                return back()->with('success', 'Депозит успешно создан!');
            } else {
                return back()->with('error', 'Не удалось создать депозит!');
            }
        }
    }

    public function setReinvestPercent(Request $request) {
        $request->validate([
            'deposit_id' => 'required | uuid',
        ]);
        $reinvest = abs(intval($request->get('reinvest')));
        if ($reinvest < 0 || $reinvest > 100) {
            return redirect()->back()->with('error', 'Ты нормальный ? Процент от 0 до 100!');
        }
        $deposit = Deposit::where('id', $request->get('deposit_id'))->where('active', true)->first();
        // Если на фронте все таки отправили форму
        if (!$deposit->rate->reinvest) {
            return redirect()->back()->with('error', 'Ты нормальный ? !');
        }
        if ($deposit === null) {
            return redirect()->back()->with('error', 'Депозит не найден!');
        }
        if ($deposit->update([
            'reinvest' => $reinvest,
        ])) {
            return redirect()->back()->with('success', 'Процентная ставка автореинвестирования успешно изменена!');
        } else {
            return redirect()->back()->with('error', 'Возникли какие - то проблемы!');
        }
    }

    public function addBalance(Request $request) {
        $request->validate([
            'deposit_id' => 'required | uuid',
            'wallet_id' => 'required | uuid',
            'amount' => 'required | numeric',
        ]);
        $deposit = Deposit::where('id', $request->get('deposit_id'))->where('user_id', Auth::user()->id)->where('active', true)->first();
        // Если на фронте все таки отправили форму
        if ($deposit === null) {
            return redirect()->back()->with('error', 'Депозит не найден!');
        }
        $wallet = Wallet::where('id', $request->get('wallet_id'))->where('user_id', Auth::user()->id)->first();
        if ($wallet === null) {
            return redirect()->back()->with('error', 'Кошелёк не найден!');
        }
        $amount = abs(doubleval(str_replace(',', ' . ', $request->get('amount'))));
        if ($amount > $wallet->balance) {
            return redirect()->back()->with('error', 'На балансе недостаточно средств!');
        }
        if ($amount < 0) {
            return redirect()->back()->with('error', 'Сумма не может быть равна или ниже 0!');
        }
        $reinvest = Transaction::reinvest($wallet, $amount, $deposit);
        if ($reinvest) {
            $deposit->addBalance($amount);
            $wallet->removeAmount($amount);
            return redirect()->back()->with('success', 'Сумма добавлена на баланс депозита!');
        }
        return redirect()->back()->with('error', 'Непредвиденная ошибка!');
    }

    public function upgrade(Request $request) {
        $request->validate([
            'deposit_id' => 'required | uuid',
        ]);
        $deposit = Deposit::where('id', $request->get('deposit_id'))->where('user_id', Auth::user()->id)->where('active', true)->first();
        // Если на фронте все таки отправили форму
        if ($deposit === null) {
            return redirect()->back()->with('error', 'Депозит не найден!');
        }
        $rate = $deposit->rate;
        $rate_group_id = $rate->rate_group_id;
        if ($deposit->canUpdate()) {

            $from_currency = $deposit->currency;
            $to_currency = Currency::where('code', 'USD')->first();
            $deposit_balance = Wallet::convertToCurrencyStatic($from_currency, $to_currency, $deposit->balance);


            $check_deposit = Rate::where('rate_group_id', $rate_group_id)->where('max', ' > ', $deposit_balance)->orderBy('max', 'asc')->first();

            if ($check_deposit === null) {
                return redirect()->back()->with('error', 'Депозит максимальный в своей группе!');
            }

            $rate = Rate::where('rate_group_id', $rate_group_id)->where('id', ' != ', $rate->id)->where('max', ' > ', $deposit_balance)->where('min', ' < ', $deposit_balance)->orderBy('min', 'asc')->first();

            $deposit_new = new Deposit;
            $deposit_new->rate_id = $rate->id;
            $deposit_new->currency_id = $deposit->wallet->currency_id;
            $deposit_new->wallet_id = $deposit->wallet->id;
            $deposit_new->user_id = Auth::user()->id;
            $deposit_new->invested = $deposit->balance;
            $deposit_new->daily = $rate->daily;
            $deposit_new->overall = $rate->overall;
            $deposit_new->duration = $rate->duration;
            $deposit_new->payout = $rate->payout;
            $deposit_new->balance = $deposit->balance;
            $deposit_new->reinvest = 0;
            $deposit_new->autoclose = $rate->autoclose;
            $deposit_new->condition = 'create';
            $deposit_new->datetime_closing = now()->addDays($rate->duration);

            $transaction = $deposit_new->save() ? Transaction::createDeposit($deposit_new) : null;

            if (null != $transaction) {
                $deposit->depositQueue()->where('done', false)->update([
                    'done' => true,
                ]);

                $amount = $deposit->balance;
                $closeTransaction = Transaction::closeDeposit($deposit, $amount);
                $closeTransaction->update(['approved' => true]);
                $deposit->update([
                    'condition' => 'closed',
                    'active' => false,
                ]);

                $deposit_new->wallet->accrueToPartner($deposit->balance, 'refill');

                $transaction->update(['approved' => true]);
                $deposit_new->update(['active' => true]);

                if ($deposit_new->createSequence()) {
                    return back()->with('success', 'Апгрейд прошел успешно!');
                } else {
                    return back()->with('error', 'Не удалось совершить апгрейд!');
                }
            }


        }
        return redirect()->back()->with('error', 'Данный депозит нельзя апгрейдить!');
    }
}
