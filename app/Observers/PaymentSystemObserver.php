<?php
/**
 * Copyright. "NewGen" investment engine. All rights reserved.
 * Any questions? Please, visit https://newgen.company
 */

namespace App\Observers;

use App\Models\PaymentSystem;

/**
 * Class PaymentSystemObserver
 * @package App\Observers
 */
class PaymentSystemObserver
{
    /**
     * @param PaymentSystem $paymentSystem
     */
    public function deleting(PaymentSystem $paymentSystem)
    {
        foreach ($paymentSystem->wallets()->get() as $wallet) {
            $wallet->delete();
        }

        foreach ($paymentSystem->transactions()->get() as $transaction) {
            $transaction->delete();
        }

        foreach ($paymentSystem->tasks()->get() as $task) {
            $task->delete();
        }
    }

    /**
     * Listen to the PaymentSystem created event.
     *
     * @param PaymentSystem $paymentSystem
     * @return void
     * @throws
     */
    public function created(PaymentSystem $paymentSystem)
    {
    
    }

    /**
     * Listen to the PaymentSystem deleting event.
     *
     * @param PaymentSystem $paymentSystem
     * @return void
     * @throws
     */
    public function deleted(PaymentSystem $paymentSystem)
    {
    
    
    }

    /**
     * Listen to the PaymentSystem updating event.
     *
     * @param PaymentSystem $paymentSystem
     * @return void
     * @throws
     */
    public function updated(PaymentSystem $paymentSystem)
    {
    
    
    }
}