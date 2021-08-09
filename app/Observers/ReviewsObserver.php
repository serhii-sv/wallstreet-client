<?php
/**
 * Copyright. "NewGen" investment engine. All rights reserved.
 * Any questions? Please, visit https://newgen.company
 */

namespace App\Observers;

use App\Models\Reviews;

/**
 * Class ReviewsObserver
 * @package App\Observers
 */
class ReviewsObserver
{
    

    /**
     * Listen to the Reviews created event.
     *
     * @param Reviews $review
     * @return void
     * @throws
     */
    public function created(Reviews $review)
    {
    
    }

    /**
     * Listen to the Reviews deleting event.
     *
     * @param Reviews $review
     * @return void
     * @throws
     */
    public function deleted(Reviews $review)
    {
    
    }

    /**
     * Listen to the Reviews updating event.
     *
     * @param Reviews $review
     * @return void
     * @throws
     */
    public function updated(Reviews $review)
    {
    
    }
}