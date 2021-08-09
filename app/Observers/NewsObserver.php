<?php
/**
 * Copyright. "NewGen" investment engine. All rights reserved.
 * Any questions? Please, visit https://newgen.company
 */

namespace App\Observers;

use App\Models\News;

/**
 * Class NewsObserver
 * @package App\Observers
 */
class NewsObserver
{
    /**
     * @param News $news
     */
    public function deleting(News $news)
    {

    }
    /**
     * Listen to the News created event.
     *
     * @param News $news
     * @return void
     * @throws
     */
    public function created(News $news)
    {

    }

    /**
     * Listen to the News deleting event.
     *
     * @param News $news
     * @return void
     * @throws
     */
    public function deleted(News $news)
    {

    }

    /**
     * Listen to the News updating event.
     *
     * @param News $news
     * @return void
     * @throws
     */
    public function updated(News $news)
    {

    }
}
