<?php
/**
 * Copyright. "NewGen" investment engine. All rights reserved.
 * Any questions? Please, visit https://newgen.company
 */

namespace App\Http\Controllers;

use App\Models\Language;
use Carbon\Carbon;

/**
 * Class LanguageController
 * @package App\Http\Controllers
 */
class LanguageController extends Controller
{
    /**
     * @param $locale
     * @return \Illuminate\Http\RedirectResponse
     */
    public function index($locale) {
        $checkExists = Language::where('code', $locale)->get()->count();

        if ($checkExists == 0) {
            return back()->with('short_error', "Ошибка кода языка");
        }

        session([
            'language' => $locale
        ]);
        setcookie('language', $locale, Carbon::now()->addDays(365)->timestamp, '/');

        return back()->with('short_success', "Язык сайта был успешно изменен");
    }

}
