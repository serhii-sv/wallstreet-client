<?php
/**
 * Copyright. "NewGen" investment engine. All rights reserved.
 * Any questions? Please, visit https://newgen.company
 */

namespace App\Observers;

use App\Models\CloudFile;
use App\Models\Currency;

class CloudFileObserver
{
    /**
     * Listen to the CloudFile created event.
     *
     * @param CloudFile $cloudFile
     * @return void
     * @throws
     */
    public function created(CloudFile $cloudFile)
    {
        cache()->forget('counts.files');
    }


    /**
     * Listen to the CloudFile deleting event.
     *
     * @param CloudFile $cloudFile
     * @return void
     * @throws
     */
    public function deleted(CloudFile $cloudFile)
    {
        cache()->forget('counts.files');
    }
}
