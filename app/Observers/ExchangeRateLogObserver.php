<?php

namespace App\Observers;

use App\Models\ExchangeRateLog;
use App\Models\Setting;

class ExchangeRateLogObserver
{
    /**
     * @param ExchangeRateLog $log
     */
    public function created(ExchangeRateLog $log)
    {
        if ($log->rate_id == (Setting::where('s_key', 'sprint_to_usd')->first()->id ?? null)) {
            Setting::setValue('usd_to_sprint', (100 / $log->new_rate));
        }
    }
}
