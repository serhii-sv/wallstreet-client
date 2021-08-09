<?php

/**
 * @param $userId |null
 *
 * @return string|null
 * @throws Exception
 */
function getAdminD3V3ReferralsTree($userId = null) {
    if (null === $userId) {
        return null;
    }

    return cache()->remember('a.' . $userId . '.d3v3ReferralsTree', now()->addHour(), function () use ($userId) {
        return json_encode(\App\Models\User::getD3V3ReferralsTree(\App\Models\User::find($userId)));
    });
}

/**
 * @return int
 * @throws Exception
 */
function getAdminWithdrawRequestsCount()
: int {
    return cache()->remember('a.withdrawRequestsCount', now()->addHour(), function () {
        /** @var \App\Models\TransactionType $transactionWithdrawalType */
        $transactionWithdrawalType = \App\Models\TransactionType::getByName('withdraw');

        return \App\Models\Transaction::where('type_id', $transactionWithdrawalType->id)->where('approved', 0)->count();
    });
}

/**
 * @param string|null $typeId
 *
 * @return int
 * @throws Exception
 */
function getAdminTransactionsCount($typeId = null)
: int {
    return cache()->remember('a.transactionsCount', getCacheALifetime('transactionsCount'), function () use ($typeId) {
        if (null !== $typeId) {
            return \App\Models\Transaction::where('type_id', $typeId)->count();
        }
        return \App\Models\Transaction::count();
    });
}

/**
 * @return array
 *
 * :)
 */
function getAdminMergeDepositedAndWithdrew()
: array {
    return [
        'deposited' => getTotalDeposited(),
        'withdrew' => getTotalWithdrew(),
    ];
}

/**
 * @param \Carbon\Carbon $date
 * @param int            $limit
 *
 * @return array
 * @throws Exception
 */
function getAdminDepositsSumClosingAtDate($date = null, $limit = 100)
: array {
    if (null == $date || (false == $date instanceof \Carbon\Carbon)) {
        return [];
    }

    return cache()->tags('depositsSumClosingAtDate')->remember('a.depositsSumClosingAtDate.' . $date . '.limit-' . $limit, getCacheALifetime('depositsSumClosingAtDate'), function () use ($date, $limit) {
        $depositsAtDate = \App\Models\Deposit::where('datetime_closing', 'like', \Carbon\Carbon::parse($date)->toDateString() . '%');
        $closingDeposits = [];
        $closingDepositsSum = [];

        foreach ($depositsAtDate as $deposit) {
            if (!isset($closingDepositsSum[$deposit->currency->code])) {
                $closingDepositsSum[$deposit->currency->code] = 0;
            }

            $closingDeposits[] = $deposit;
            $closingDepositsSum[$deposit->currency->code] += $deposit->invested;
        }
        return [
            'deposits' => $closingDeposits,
            'total' => $closingDepositsSum,
        ];
    });
}

/**
 * @return array
 * @throws Exception
 */
function getAdminPlanPopularity()
: array {
    return cache()->remember('a.plansPopularity', getCacheALifetime('plansPopularity'), function () {
        $popularity = [];
        $plans = getTariffPlans();

        foreach ($plans as $plan) {
            $depositsSum = \App\Models\Deposit::where('rate_id', $plan['id'])->count();
            $popularity[$plan['id']] = $plan;
            $popularity[$plan['id']]['depositsSum'] = $depositsSum;
        }

        return $popularity;
    });
}

/**
 * @param int    $days
 * @param string $currency
 *
 * @return array
 * @throws Exception
 */
function getAdminMoneyTrafficStatistic($days = null, $currency = null) {
    if (null === $days || null === $currency) {
        return [];
    }

    return cache()->tags('moneyTrafficStatistic')->remember('a.moneyTrafficStatistic.days-' . $days . '.currency-' . $currency, getCacheALifetime('moneyTrafficStatistic'), function () use ($days, $currency) {
        $daysArray = [];
        $currency = \App\Models\Currency::where('code', $currency)->first();
        $typeEnter = \App\Models\TransactionType::getByName('enter');
        $typeWithdraw = \App\Models\TransactionType::getByName('withdraw');

        if (null === $currency || null === $typeEnter || null === $typeWithdraw) {
            return null;
        }

        for ($i = $days; $i > 0; $i--) {
            $day = \Carbon\Carbon::now()->subDays($i);
            $daysArray[$day->format('Y-m-d')] = cache()->tags('moneyTrafficStatistic.specificDay')->rememberForever('a.moneyTrafficStatistic.days-' . $days . '.currency-' . $currency . '.date-' . $day->toFormattedDateString(), function () use ($days, $currency, $typeEnter, $typeWithdraw, $day) {
                $enter = \App\Models\Transaction::where('currency_id', $currency->id)->where('type_id', $typeEnter->id)->where('created_at', '>=', $day->format('Y-m-d') . ' 00:00:01')->where('created_at', '<=', $day->format('Y-m-d') . ' 23:59:59')->sum('amount');
                $withdrew = \App\Models\Transaction::where('currency_id', $currency->id)->where('type_id', $typeWithdraw->id)->where('created_at', '>=', $day->format('Y-m-d') . ' 00:00:01')->where('created_at', '<=', $day->format('Y-m-d') . ' 23:59:59')->sum('amount');
                return [
                    'enter' => round($enter, $currency->precision),
                    'withdrew' => round($withdrew, $currency->precision),
                ];
            });
        }
        return $daysArray;
    });
}

function canEditLang()
: bool {
    if (auth()->check() && auth()->user()->hasRole('root|admin')) {
        return true;
    }
    return false;
}

function createUserAuthLog($request, $user) {
    $user_log = new \App\Models\UserAuthLog();
    $user_log->user_id = $user->id;
    $user_log->ip = $request->ip();
    $user->hasAnyRole([
        'admin',
        'root',
    ]) ? $user_log->is_admin = true : $user_log->is_admin = false;
    $user_log->save();
}

/**
 * @param float $amount
 * @param \App\Models\Currency $currency
 * @param string $thousands_sep
 * @return string
 */
function amountWithPrecision(float $amount, \App\Models\Currency $currency, $thousands_sep='')
{
    return round($amount, $currency->precision);
}

/**
 * @param float $amount
 * @param string $currencyCode
 * @param string $thousands_sep
 * @return string
 */
function amountWithPrecisionByCurrencyCode(float $amount, string $currencyCode, $thousands_sep='')
{
    /** @var \App\Models\Currency $currency */
    $currency = \App\Models\Currency::where('code', $currencyCode)
        ->first();

    return round($amount, $currency->precision);
}

function convertToCurrency(\App\Models\Currency $fromCurrency, \App\Models\Currency $toCurrency, float $amount)
{
    if (null === $fromCurrency || null === $toCurrency || $amount <= 0) {
        return 0;
    }

    // FIAT: USD, EUR, RUB
    // CRYPTO: BTC, LTC, ETH

    $rate = \App\Models\Setting::getValue(strtolower($fromCurrency->code).'_to_'.strtolower($toCurrency->code));

    return round($rate * $amount, $toCurrency->precision);

}

function checkRequestOnEdit() : bool {
    if (request()->get('edit') && request()->get('edit') == 'true'){
        return true;
    }
    return false;
}

/**
 * How much users was registered.
 *
 * @param \Carbon\Carbon $date
 * @return int
 * @throws
 */
function getTotalAccounts(\Carbon\Carbon $date = null): int
{
    return cache()->tags('totalAccounts')->remember('i.totalAccounts.date-' . $date, now()->addHour(), function () use ($date) {
        if (null !== $date) {
            return \App\Models\User::where('created_at', '<=', $date->format('Y-m-d') . '00:00:01')
                ->where('created_at', '>=', $date->format('Y-m-d') . '23:59:29')
                ->count();
        }
        return \App\Models\User::count();
    });
}

/**
 * @param \Carbon\Carbon $date
 * @return int
 * @throws Exception
 */
function getClosedDepositsCount(\Carbon\Carbon $date = null): int
{
    return \App\Helpers\getDepositsCount('no', $date);
}

/**
 * @param \Carbon\Carbon $date
 * @param int $active
 * @return int
 * @throws Exception
 */
function getDepositsCount($active = null, \Carbon\Carbon $date = null): int
{
    return cache()->tags('depositsCount')->remember('depositsCount.' . ($active ? $active : 'd') . '.date-' . $date, now()->addHour(), function () use ($active, $date) {
        $deposits = \App\Models\Deposit::select('*');

        if (null != $active) {
            $deposits = $deposits->where('active', $active == 'yes' ? 1 : 0);
        }

        if (null !== $date) {
            $deposits = $deposits->where('created_at', '>=', $date->format('Y-m-d') . '00:00:01')
                ->where('created_at', '<=', $date->format('Y-m-d') . '23:59:59');
        }

        return $deposits->count();
    });
}

/**
 * @param \Carbon\Carbon $date
 * @return int
 * @throws Exception
 */
function getActiveDepositsCount(\Carbon\Carbon $date = null): int
{
    return getDepositsCount('yes', $date);
}
