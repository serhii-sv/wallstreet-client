<?php

namespace App\Http\ViewComposers;

use App\Models\User;
use Illuminate\Support\Facades\Route;
use Illuminate\View\View;

class BreadcrumbsComposer
{
    /**
     * The user repository implementation.
     *
     * @var User
     */
    protected $users;

    /**
     * Create a new profile composer.
     *
     * @param User $users
     *
     * @return void
     */
    public function __construct() {

    }

    /**
     * Bind data to the view.
     *
     * @param View $view
     *
     * @return void
     */
    public function compose(View $view) {
        $view
            ->with('breadcrumbs', [
                'accountPanel.settings.security' => 'Настройки безопасности',
                'accountPanel.dashboard' => 'Главная'
            ][Route::getCurrentRoute()->getName()]);

    }
}
