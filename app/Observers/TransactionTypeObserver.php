<?php
/**
 * Copyright. "NewGen" investment engine. All rights reserved.
 * Any questions? Please, visit https://newgen.company
 */

namespace App\Observers;

use App\Models\TransactionType;

/**
 * Class TransactionTypeObserver
 * @package App\Observers
 */
class TransactionTypeObserver
{
    /**
     * @param TransactionType $transactionType
     */
    public function deleting(TransactionType $transactionType)
    {
        foreach ($transactionType->transactions()->get() as $transaction) {
            $transaction->delete();
        }
    }

    /**
     * Listen to the TransactionType created event.
     *
     * @param TransactionType $transactionType
     * @return void
     * @throws
     */
    public function created(TransactionType $transactionType)
    {
    
    }

    /**
     * Listen to the TransactionType deleting event.
     *
     * @param TransactionType $transactionType
     * @return void
     * @throws
     */
    public function deleted(TransactionType $transactionType)
    {
    
    }

    /**
     * Listen to the TransactionType updating event.
     *
     * @param TransactionType $transactionType
     * @return void
     * @throws
     */
    public function updated(TransactionType $transactionType)
    {
    
    }
}