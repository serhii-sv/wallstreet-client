<?php
/**
 * Copyright. "NewGen" investment engine. All rights reserved.
 * Any questions? Please, visit https://newgen.company
 */

namespace App\Observers;

use App\Models\Referral;

/**
 * Class ReferralObserver
 * @package App\Observers
 */
class ReferralObserver
{
    /**
     * Listen to the Referral created event.
     *
     * @param Referral $referral
     * @return void
     * @throws
     */
    public function created(Referral $referral)
    {
    
    }

    /**
     * Listen to the Referral deleting event.
     *
     * @param Referral $referral
     * @return void
     * @throws
     */
    public function deleted(Referral $referral)
    {
    
    }

    /**
     * Listen to the Referral updating event.
     *
     * @param Referral $referral
     * @return void
     * @throws
     */
    public function updated(Referral $referral)
    {
    
    }
}