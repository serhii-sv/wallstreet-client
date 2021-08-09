<?php
/**
 * Copyright. "NewGen" investment engine. All rights reserved.
 * Any questions? Please, visit https://newgen.company
 */

namespace App\Observers;

use App\Models\Rate;

/**
 * Class RateObserver
 * @package App\Observers
 */
class RateObserver
{
    /**
     * @param Rate $rate
     */
    public function deleting(Rate $rate)
    {
        foreach ($rate->deposits()->get() as $deposit) {
            $deposit->delete();
        }

        foreach ($rate->transactions()->get() as $transaction) {
            $transaction->delete();
        }
    }

    /**
     * Listen to the Rate created event.
     *
     * @param Rate $rate
     * @return void
     * @throws
     */
    public function created(Rate $rate)
    {
    
    }

    
    /**
     * Listen to the Rate deleting event.
     *
     * @param Rate $rate
     * @return void
     * @throws
     */
    public function deleted(Rate $rate)
    {
    
    }

    /**
     * Listen to the Rate updating event.
     *
     * @param Rate $rate
     * @return void
     * @throws
     */
    public function updated(Rate $rate)
    {
    
    }
}