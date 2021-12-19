<?php
/**
 * Copyright. "NewGen" investment engine. All rights reserved.
 * Any questions? Please, visit https://newgen.company
 */

namespace App\Providers;

use App\Models\CloudFile;
use App\Models\Currency;
use App\Models\Deposit;
use App\Models\ExchangeRateLog;
use App\Models\Faq;
use App\Models\Language;
use App\Models\MailSent;
use App\Models\News;
use App\Models\PaymentSystem;
use App\Models\Rate;
use App\Models\Referral;
use App\Models\Reviews;
use App\Models\Setting;

//use App\Models\TplDefaultLang;
use App\Models\Transaction;
use App\Models\TransactionType;
use App\Models\User;
use App\Models\UserSidebarProperties;
use App\Models\Wallet;
use App\Observers\CloudFileObserver;
use App\Observers\CurrencyObserver;
use App\Observers\DepositObserver;
use App\Observers\ExchangeRateLogObserver;
use App\Observers\FaqObserver;
use App\Observers\LanguageObserver;
use App\Observers\NewsObserver;
use App\Observers\PaymentSystemObserver;
use App\Observers\RateObserver;
use App\Observers\ReferralObserver;
use App\Observers\ReviewsObserver;
use App\Observers\SettingObserver;
use App\Observers\TransactionObserver;
use App\Observers\TransactionTypeObserver;
use App\Observers\UserObserver;
use App\Observers\UserSidebarPropertyObserver;
use App\Observers\WalletObserver;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Laravel\Horizon\Horizon;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot() {
        Paginator::defaultView('vendor.pagination.default');
        Horizon::auth(function ($request) {
            $user = \Auth::user();

            if (null === $user) {
                return false;
            }

            return $user->hasRole([
                'root',
            ]);
        });

        /*
         * Base observers
         */
        Currency::observe(CurrencyObserver::class);
        CloudFile::observe(CloudFileObserver::class);
        Deposit::observe(DepositObserver::class);
        Faq::observe(FaqObserver::class);
        Language::observe(LanguageObserver::class);
        News::observe(NewsObserver::class);
        PaymentSystem::observe(PaymentSystemObserver::class);
        Rate::observe(RateObserver::class);
        Referral::observe(ReferralObserver::class);
        Reviews::observe(ReviewsObserver::class);
        Setting::observe(SettingObserver::class);
        Transaction::observe(TransactionObserver::class);
        ExchangeRateLog::observe(ExchangeRateLogObserver::class);
        TransactionType::observe(TransactionTypeObserver::class);
        User::observe(UserObserver::class);
        \App\User::observe(UserObserver::class);
        Wallet::observe(WalletObserver::class);
        UserSidebarProperties::observe(UserSidebarPropertyObserver::class);
        //Task::observe(TaskObserver::class);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register() {
        //
    }
}
