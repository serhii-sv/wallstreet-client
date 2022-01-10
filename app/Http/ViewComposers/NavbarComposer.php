<?php


namespace App\Http\ViewComposers;


use App\Models\ChatMessage;
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
            $userNotifications = \App\Models\NotificationUser::whereHas('notification')
                ->where('user_id', Auth::user()->id)
                ->where('is_read', false)
                ->where('created_at', '>', now()->subDays(7))
                ->orderBy('created_at', 'desc');

            $view->with('counts', [
                'notifications' => $userNotifications->count(),
            ]);
            $view->with('navbar_notifications', $userNotifications->get());
        }

        $view->with('currency_rates', cache()->remember('rates.', now()->addHours(3), function() {
            $rates = [];
            $currencies = Currency::pluck('code', 'name');
            foreach ($currencies as $currency_name => $currency_code) {
                if (!(strtolower($currency_code) == 'usd')) {
                    $key = strtolower($currency_code) . '_to_usd';
                    $rate = Setting::where('s_key', $key)->first();
                    if (!empty($rate)) {
                        $rates[$currency_name . ' to U.S dollars'] = $rate->s_value;
                    }
                }
                if (!(strtolower($currency_code) == 'usd')) {
                    $key = 'usd_to_' . strtolower($currency_code);
                    $rate = Setting::where('s_key', $key)->first();
                    if (!empty($rate)) {
                        $rates['U.S dollars to ' . $currency_name] = $rate->s_value;
                    }
                }
            }
            return $rates;
        }));

        $view->with('languages', Language::all());
        $view->with('default_language', Language::where('default', 'true')->first());
        if (Auth::check()) {
            $chats = Auth::user()->getAllChats()->pluck('id')->toArray();
            $view->with('total_unread_messages', ChatMessage::whereIn('chat_id', $chats)->where('is_read', false)->count());
        }
    }
}
