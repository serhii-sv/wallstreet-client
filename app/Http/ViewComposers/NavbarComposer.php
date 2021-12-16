<?php


namespace App\Http\ViewComposers;


use App\Models\Currency;
use App\Models\Language;
use App\Models\Setting;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class NavbarComposer
{

    public function compose(View $view)
    {
        if (Auth::check()) {
            $userNotifications = \App\Models\NotificationUser::where('user_id', Auth::user()->id)
                ->where('is_read', false)
                ->where('created_at', '>', now()->subDays(7))
                ->orderBy('created_at', 'desc')
                ->get();

            $view->with('counts', [
                'notifications' => $userNotifications->count(),
            ]);
            $view->with('navbar_notifications', $userNotifications);
        }
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

        $view->with('languages', Language::all());
        $view->with('default_language', Language::where('default', 'true')->first());
        $total_unread_messages = 0;
        if (Auth::check()) {
            foreach (Auth::user()->getAllChats() as $item) {
                $total_unread_messages += $item->getUnreadMessagesCount(Auth::user()->id);
            }
            $view->with('total_unread_messages', $total_unread_messages);
        }
    }
}
