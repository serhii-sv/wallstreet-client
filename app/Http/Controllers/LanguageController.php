<?php
/**
 * Copyright. "NewGen" investment engine. All rights reserved.
 * Any questions? Please, visit https://newgen.company
 */

namespace App\Http\Controllers;

use App\Models\Language;

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
            return back()->with('error', __('Language code error'));
        }

        session([
            'lang' => $locale
        ]);
        return back()->with('success', __('The site language has been changed successfully'));
    }

}
