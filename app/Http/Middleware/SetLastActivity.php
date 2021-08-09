<?php
/**
 * Copyright. "NewGen" investment engine. All rights reserved.
 * Any questions? Please, visit https://newgen.company
 */

namespace App\Http\Middleware;

use Closure;
use App;
use Illuminate\Support\Facades\Auth;

/**
 * Class SetLang
 * @package App\Http\Middleware
 */
class SetLastActivity
{
    /**
     * @param $request
     * @param Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        //Auth::user()->removeRole('admin');
        if(auth()->check()) {
            auth()->user()->setLastActivity();
        }

        return $next($request);
    }
}
