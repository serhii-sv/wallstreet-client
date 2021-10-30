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

        if (!session()->has('lang')) {
            session()->put('lang', $defaultLang);
        }

        if (!isset($_COOKIE['lang'])) {
            setcookie('lang', $defaultLang, Carbon::now()->addDays(365)->timestamp, '/');
        }

        if (isset($_COOKIE['lang']) && !session()->has('lang')) {
            session([
                'lang' => $_COOKIE['lang']
            ]);
        }

        $locale = session()->has('lang')
            ? session('lang')
            : $defaultLang;

        die($locale.'/'.session('lang'));

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
