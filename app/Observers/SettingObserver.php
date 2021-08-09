<?php
/**
 * Copyright. "NewGen" investment engine. All rights reserved.
 * Any questions? Please, visit https://newgen.company
 */

namespace App\Observers;

use App\Models\Setting;

/**
 * Class SettingObserver
 * @package App\Observers
 */
class SettingObserver
{
    /**
     * Listen to the Setting created event.
     *
     * @param Setting $setting
     * @return void
     * @throws
     */
    public function created(Setting $setting)
    {
    
    }

    /**
     * Listen to the Setting deleting event.
     *
     * @param Setting $setting
     * @return void
     * @throws
     */
    public function deleted(Setting $setting)
    {
    
    }

    /**
     * Listen to the Setting updating event.
     *
     * @param Setting $setting
     * @return void
     * @throws
     */
    public function updated(Setting $setting)
    {
    
    }
}