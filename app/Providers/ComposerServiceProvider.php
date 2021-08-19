<?php
/**
 * Copyright. "NewGen" investment engine. All rights reserved.
 * Any questions? Please, visit https://newgen.company
 */

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer(
            ['layouts.accountPanel.header'], 'App\Http\ViewComposers\DashboardComposer'
        );
        View::composer(
            ['layouts.accountPanel.header'], 'App\Http\ViewComposers\NavbarComposer'
        );
        View::composer(
            ['layouts.accountPanel.breadcrumbs'], 'App\Http\ViewComposers\BreadcrumbsComposer'
        );
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
