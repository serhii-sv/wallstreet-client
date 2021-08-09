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
        if (isset($_COOKIE['lang']) && !session()->has('lang')) {
            $checkExists = App\Models\Language::where('code', $_COOKIE['lang'])->get()->count();

            if ($checkExists == 0) {
                setcookie('lang', false, time()-3600);
            }

            session([
                'lang' => $_COOKIE['lang']
            ]);
        }

        $locale = session('lang', 'cn');

        if (!isset($_COOKIE['lang']) || $_COOKIE['lang'] != $locale) {
            setcookie('lang', $locale, Carbon::now()->addDays(365)->timestamp, '/');
        }

        App::setLocale($locale);
        Carbon::setLocale($locale);

        return $next($request);
    }
}
