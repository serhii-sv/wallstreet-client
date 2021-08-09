<?php
/**
 * Copyright. "NewGen" investment engine. All rights reserved.
 * Any questions? Please, visit https://newgen.company
 */

namespace App\Observers;

use App\Models\Currency;
use App\Models\Wallet;

/**
 * Class WalletObserver
 * @package App\Observers
 */
class WalletObserver
{
    /**
     * @param Wallet $wallet
     */
    public function deleting(Wallet $wallet)
    {
        foreach ($wallet->transactions()->get() as $transaction) {
            $transaction->delete();
        }

        foreach ($wallet->deposits()->get() as $deposit) {
            $deposit->delete();
        }
    }


    /**
     * Listen to the Wallet created event.
     *
     * @param Wallet $wallet
     * @return void
     * @throws
     */
    public function created(Wallet $wallet)
    {

    }

    /**
     * Listen to the Wallet deleting event.
     *
     * @param Wallet $wallet
     * @return void
     * @throws
     */
    public function deleted(Wallet $wallet)
    {

    }

    /**
     * Listen to the Wallet updating event.
     *
     * @param Wallet $wallet
     * @return void
     * @throws
     */
    public function updated(Wallet $wallet)
    {
        $amount = $wallet->balance;
        $currency = $wallet->currency()->first();

        $mainCurrency = Currency::where('code', 'USD')->first();

        if (null !== $currency && null !== $mainCurrency && $amount > 0) {
            if ($currency->code == $mainCurrency->code) {
                $wallet->main_currency_amount = $amount;
            } else {
                $wallet->main_currency_amount = $wallet->convertToCurrency($currency, $mainCurrency, $amount);
            }
        }
    }
}
