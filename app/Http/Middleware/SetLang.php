<?php
/**
 * Copyright. "NewGen" investment engine. All rights reserved.
 * Any questions? Please, visit https://newgen.company
 */

namespace App\Http\Middleware;

use Carbon\Carbon;
use Closure;
use App;

/**
 * Class SetLang
 * @package App\Http\Middleware
 */
class SetLang
{
    /**
     * @param $request
     * @param Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        /*
         * Language
         */
        $defaultLang = 'ru';

        if (!session()->has('language')) {
            session()->put('language', $defaultLang);
        }

        if (!isset($_COOKIE['language'])) {
            setcookie('language', $defaultLang, Carbon::now()->addDays(365)->timestamp, '/');
        }

        if (isset($_COOKIE['language']) && !session()->has('language')) {
            session([
                'language' => $_COOKIE['language']
            ]);
        }

        $locale = session()->has('language')
            ? session('language')
            : $defaultLang;

        App::setLocale($locale);
        Carbon::setLocale($locale);

        // ------

        /*
         * Timezone
         */
        $timezone = App\Models\Setting::getValue('timezone', 'Europe/Dublin');
        date_default_timezone_set($timezone);

        return $next($request);
    }
}
