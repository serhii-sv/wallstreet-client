<?php
/**
 * Copyright. "NewGen" investment engine. All rights reserved.
 * Any questions? Please, visit https://newgen.company
 */

namespace App\Observers;

use App\Models\Currency;
use App\Models\Transaction;
use App\Models\TransactionType;
use App\Models\UserSidebarProperties;

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
        if ($transaction->type_id == TransactionType::getByName('withdraw')->id && $transaction->approved == false){
            $withdrawals_amount = UserSidebarProperties::where('sb_prop','withdrawals_amount')->get();
            foreach ($withdrawals_amount as $item) {
                $item->sb_val = abs(intval($item->sb_val + $transaction->main_currency_amount));
                $item->save();
            }
        }
        if ($transaction->type_id == TransactionType::getByName('enter')->id && $transaction->approved == true){
            $replenishments_amount = UserSidebarProperties::where('sb_prop','replenishments_amount')->get();
            foreach ($replenishments_amount as $item) {
                $item->sb_val = abs(intval($item->sb_val + $transaction->main_currency_amount));
                $item->save();
            }
        }
        if ($transaction->type_id == TransactionType::getByName('exchange_out')->id && $transaction->approved == true){
            $currency_exchange_count = UserSidebarProperties::where('sb_prop','currency_exchange_count')->get();
            foreach ($currency_exchange_count as $item) {
                $item->sb_val = abs($item->sb_val + 1);
                $item->save();
            }
        }

        cache()->forget('referrals.total_invested_'.$transaction->user_id);
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
        }else{
            $transaction->main_currency_amount = $amount;
        }
    }
}
