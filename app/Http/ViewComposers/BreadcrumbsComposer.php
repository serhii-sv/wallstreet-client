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
        $route_data = [
            'default' => '',
            'accountPanel.settings.security' => 'Настройки безопасности',
            'accountPanel.dashboard' => 'Главная',
            'accountPanel.profile' => 'Редактирование профиля',
        ];
        if (array_key_exists(Route::getCurrentRoute()->getName(), $route_data))
        {
            $key = Route::getCurrentRoute()->getName();
        }else{
            $key = 'default';
        }
        $view
            ->with('breadcrumbs', $route_data[$key]);

    }
}
