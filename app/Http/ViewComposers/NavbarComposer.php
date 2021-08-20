<?php


namespace App\Http\ViewComposers;


use App\Models\Currency;
use App\Models\Setting;
use App\Modules\Parsers\FixerModule;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class NavbarComposer
{
    
    public function compose(View $view) {
        if (Auth::check()) {
            $view->with('counts', [
                'notifications' => \App\Models\NotificationUser::where('user_id', Auth::user()->id)->where('is_read', false)->count(),
            ]);
            $view->with('navbar_notifications', \App\Models\NotificationUser::where('user_id', Auth::user()->id)->where('is_read', false)->get());
            
            $currencies = Currency::all();
            
            $rates = [];
            foreach ($currencies as $currency) {
                if (!(strtolower($currency->code) == 'usd')) {
                    $key = strtolower($currency->code) . '_to_usd';
                    $rate = Setting::where('s_key', $key)->first();
                    if (!empty($rate)) {
                        $rates[$currency->name . ' to U.S dollars'] = $rate->s_value;
                    }
                }
                if (!(strtolower($currency->code) == 'usd')) {
                    $key = 'usd_to_' . strtolower($currency->code);
                    $rate = Setting::where('s_key', $key)->first();
                    if (!empty($rate)) {
                        $rates['U.S dollars to ' . $currency->name] = $rate->s_value;
                    }
                }
            }
            $view->with('currency_rates', $rates);
        }
        
    }
}