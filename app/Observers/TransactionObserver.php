<?php
/**
 * Copyright. "NewGen" investment engine. All rights reserved.
 * Any questions? Please, visit https://newgen.company
 */

namespace App\Observers;

use App\Models\Currency;
use App\Models\Transaction;

/**
 * Class TransactionObserver
 * @package App\Observers
 */
class TransactionObserver
{
    

    /**
     * Listen to the Transaction created event.
     *
     * @param Transaction $transaction
     * @return void
     * @throws
     */
    public function created(Transaction $transaction)
    {
    
    }

    /**
     * Listen to the Transaction deleting event.
     *
     * @param Transaction $transaction
     * @return void
     * @throws
     */
    public function deleted(Transaction $transaction)
    {
    
    }

    /**
     * Listen to the Transaction updating event.
     *
     * @param Transaction $transaction
     * @return void
     * @throws
     */
    public function updated(Transaction $transaction)
    {
    
    }

    /**
     * @param Transaction $transaction
     */
    public function creating(Transaction $transaction)
    {
        $amount     = $transaction->amount;
        $currency   = $transaction->currency;

        /** @var Currency $mainCurrency */
        $mainCurrency = Currency::where('code', 'USD')->first();

        if (null !== $currency && null !== $mainCurrency && $amount > 0) {
            if ($currency->code == $mainCurrency->code) {
                $transaction->main_currency_amount = $amount;
            } else {
                $transaction->main_currency_amount = $transaction->convertToCurrency($currency, $mainCurrency, $amount);
            }
        }
    }
}