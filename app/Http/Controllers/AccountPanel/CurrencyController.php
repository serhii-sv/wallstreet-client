<?php

namespace App\Http\Controllers\AccountPanel;

use App\Http\Controllers\Controller;
use App\Models\Currency;
use App\Models\CurrencyExchange;
use App\Models\ExchangeRateLog;
use App\Models\Setting;
use App\Models\Transaction;
use App\Models\User;
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

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function currencyExchange(Request $request) {
        $request->validate(
            [
                'amount' => 'required',
                'wallet_from' => 'required',
                'wallet_to' => 'required',
            ],
            [
                'wallet_from.required' => 'Поле :attribute обязательно',
                'wallet_to.required' => 'Поле :attribute обязательно',
                'amount.required' => 'Поле сумма обязательно'
            ]
        );

        if ($request->get('wallet_from') == $request->get('wallet_to')){
            return redirect()->back()->with('error', 'Кошельки должны отличаться!');
        }

        /** @var float $amount */
        $amount = (float) abs($request->get('amount'));

        /** @var float $commission */
        $commission = 1; // %

        /** @var Wallet $wallet_from */
        $wallet_from = Wallet::where('user_id', Auth::user()->id)->where('id', $request->get('wallet_from'))->first();

        /** @var Wallet $wallet_to */
        $wallet_to = Wallet::where('user_id', Auth::user()->id)->where('id', $request->get('wallet_to'))->first();

        //  $balance = $wallet_from->convertToCurrency($wallet->currency()->first(), $toCurrency, abs($wallet->balance));
        if ($amount > $wallet_from->balance) {
            return redirect()->back()->with('error', 'Недостаточно средств на балансе!');
        }

        /** @var User $user */
        $user = auth()->user();

        $existsLatestCurrencyExchange = CurrencyExchange::where('user_id', $user->id)
            ->where('created_at', '>=', now()->subHours(6))
            ->count() > 0;

        if ($existsLatestCurrencyExchange > 0) {
            return redirect()->back()->with('error', 'Нельзя проводить обмены чаще чем раз в 6 часов.');
        }

        DB::beginTransaction();

        try {
            if ($wallet_from->exchangeCurrency($wallet_from, $wallet_to, $amount, $commission)) {
                DB::commit();
                return redirect()->back()->with('success', 'Обмен успешно произведён!');
            } else {
                return back()->with('error', 'Ошибка! Не получилось обменять');
            }
        } catch (\Exception $exception) {
            DB::rollBack();
            return back()->with('error', 'Ошибка! ' . $exception->getMessage());
        }
    }

    public function getExchangeRate(Request $request)
    {
        $request->validate(
            [
                'amount' => 'required',
                'wallet_from' => 'required',
                'wallet_to' => 'required',
            ],
            [
                'wallet_from.required' => 'Поле :attribute обязательно',
                'wallet_to.required' => 'Поле :attribute обязательно',
                'amount.required' => 'Поле сумма обязательно'
            ]
        );

        if ($request->get('wallet_from') == $request->get('wallet_to')){
            return 0;
        }

        /** @var float $amount */
        $amount = (float) abs($request->get('amount'));

        /** @var float $commission */
        $commission = 1; // %

        /** @var Wallet $wallet_from */
        $wallet_from = Wallet::where('user_id', Auth::user()->id)->where('id', $request->get('wallet_from'))->firstOrFail();

        /** @var Wallet $wallet_to */
        $wallet_to = Wallet::where('user_id', Auth::user()->id)->where('id', $request->get('wallet_to'))->firstOrFail();




        $converted = $wallet_from->convertToCurrency($wallet_from->currency, $wallet_to->currency, (abs($amount) - (abs($amount) / 100 * $commission)));
        $rate = $wallet_from->convertToCurrency($wallet_from->currency, $wallet_to->currency, 1);

        return [
            'amount' => $converted,
            'rate' => $rate,
        ];
    }
}
