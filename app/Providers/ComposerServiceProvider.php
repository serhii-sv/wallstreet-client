<?php
/**
 * Copyright. "NewGen" investment engine. All rights reserved.
 * Any questions? Please, visit https://newgen.company
 */

namespace App\Providers;

use App\Http\ViewComposers\AppComposer;
use App\Http\ViewComposers\BreadcrumbsComposer;
use App\Http\ViewComposers\DashboardComposer;
use App\Http\ViewComposers\NavbarComposer;
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
            ['layouts.accountPanel.header'], DashboardComposer::class
        );
        View::composer(
            ['layouts.accountPanel.app'], AppComposer::class
        );
        View::composer(
            ['layouts.app-header'], NavbarComposer::class
        );
        View::composer(
            ['layouts.accountPanel.header'], NavbarComposer::class
        );
        View::composer(
            ['layouts.accountPanel.footer'], NavbarComposer::class
        );
        View::composer(
            ['layouts.app-header'], NavbarComposer::class
        );
        View::composer(
            ['layouts.accountPanel.sidebar'], NavbarComposer::class
        );
        View::composer(
            ['layouts.accountPanel.breadcrumbs'], BreadcrumbsComposer::class
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
