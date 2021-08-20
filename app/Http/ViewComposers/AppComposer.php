<?php


namespace App\Http\ViewComposers;


use App\Models\UserThemeSetting;
use Illuminate\View\View;

class AppComposer
{
    public function compose(View $view) {
     
        $view->with('themeSettings', UserThemeSetting::getThemeSettings());
    }
}