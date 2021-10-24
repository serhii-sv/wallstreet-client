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

        $path = resource_path('lang/' . $defaultLang . '.json');

        if (!file_exists($path)) {
            session()->flash('error','Translation error. lang/'.$defaultLang.'.json is not exists.');
            $defaultLang = 'en';
        }

        if (isset($_COOKIE['language']) && !session()->has('language')) {
            $_COOKIE['lang']    = preg_replace('/[^A-Za-z]/', '', trim($_COOKIE['lang']));
            $checkExists        = file_exists(resource_path('lang/'.$_COOKIE['lang'].'.json'));

            if (false == $checkExists) {
                setcookie('lang', false, time()-3600);
            } else {
                session([
                    'lang' => $_COOKIE['lang']
                ]);
            }
        }

        $locale = session('language', $defaultLang);

        if (!isset($_COOKIE['language']) || $_COOKIE['language'] != $locale) {
            setcookie('lang', $locale, Carbon::now()->addDays(365)->timestamp, '/');
        }

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
