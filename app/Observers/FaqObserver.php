<?php
/**
 * Copyright. "NewGen" investment engine. All rights reserved.
 * Any questions? Please, visit https://newgen.company
 */

namespace App\Observers;

use App\Models\Faq;

/**
 * Class FaqObserver
 * @package App\Observers
 */
class FaqObserver
{
    /**
     * Listen to the Faq created event.
     *
     * @param Faq $faq
     * @return void
     * @throws
     */
    public function created(Faq $faq)
    {
    
    }

    /**
     * Listen to the Faq deleting event.
     *
     * @param Faq $faq
     * @return void
     * @throws
     */
    public function deleted(Faq $faq)
    {
    
    }

    /**
     * Listen to the Faq updating event.
     *
     * @param Faq $faq
     * @return void
     * @throws
     */
    public function updated(Faq $faq)
    {
    
    }
}