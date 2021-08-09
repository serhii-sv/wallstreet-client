<?php

namespace App\Http\ViewComposers;

use App\Models\User;
use App\Models\UserGeoip;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class UserGeoipComposer
{
    /**
     * The user repository implementation.
     *
     * @var User
     */
    protected $user;
    protected $userGeoip;
    
    public function __construct() {
        if (Auth::check()) {
            $this->user = Auth::user();
            $this->userGeoip = UserGeoip::where('user_id', $this->user->id)->where('created_at', '>=', now()->subMinute(10))->first();
        } else {
            $this->user = null;
            $this->userGeoip = null;
        }
    }
    
    public function compose(View $view) {
        $view->with('user_geoip', $this->userGeoip);
    }
}