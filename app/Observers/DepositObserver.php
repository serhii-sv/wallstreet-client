<?php
/**
 * Copyright. "NewGen" investment engine. All rights reserved.
 * Any questions? Please, visit https://newgen.company
 */

namespace App\Observers;

use App\Models\Deposit;

/**
 * Class DepositObserver
 * @package App\Observers
 */
class DepositObserver
{
    /**
     * @param Deposit $deposit
     */
    public function deleting(Deposit $deposit)
    {
        foreach ($deposit->transactions()->get() as $transaction) {
            $transaction->delete();
        }
    }

    /**
     * @param Deposit $deposit
     * @return array
     */

    /**
     * @param Deposit $deposit
     * @return array
     */


    /**
     * Listen to the Deposit created event.
     *
     * @param Deposit $deposit
     * @return void
     * @throws
     */
    public function created(Deposit $deposit)
    {

    }

    /**
     * Listen to the Deposit deleting event.
     *
     * @param Deposit $deposit
     * @return void
     * @throws
     */
    public function deleted(Deposit $deposit)
    {
 
    }

    /**
     * Listen to the Deposit updating event.
     *
     * @param Deposit $deposit
     * @return void
     * @throws
     */
    public function updated(Deposit $deposit)
    {
    
    }
}