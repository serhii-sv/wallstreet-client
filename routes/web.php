<?php
/**
 * Copyright. "NewGen" investment engine. All rights reserved.
 * Any questions? Please, visit https://newgen.company
 */

//use Illuminate\Routing\Route;

use App\Http\Controllers\AccountPanel\AccountSettingsController;
use App\Http\Controllers\AccountPanel\CalendarController;
use App\Http\Controllers\AccountPanel\ImpersonateController;
use App\Http\Controllers\AccountPanel\CurrencyController;
use App\Http\Controllers\AccountPanel\DepositsController;
use App\Http\Controllers\AccountPanel\DashboardController;
use App\Http\Controllers\AccountPanel\LanguageController;
use App\Http\Controllers\AccountPanel\ProfileController;
use App\Http\Controllers\AccountPanel\ReferralsController;
use App\Http\Controllers\AccountPanel\TransactionsController;
use App\Http\Controllers\AccountPanel\WithdrawalContoller;
use App\Http\Controllers\Ajax\NotificationsController;
use App\Http\Controllers\Ajax\UserThemeSettingController;
use App\Http\Controllers\AccountPanel\ChatController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\IsoController;
use App\Http\Controllers\Payment\CoinpaymentsController;
use App\Http\Controllers\Payment\FreeKassaController;
use App\Http\Controllers\Payment\PerfectMoneyController;
use App\Http\Controllers\ReplenishmentController;
use App\Http\Controllers\SetPartnerController;
use App\Models\PaymentSystem;
use App\Models\Transaction;
use App\Models\Wallet;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::post('/perfectmoney/status', [PerfectMoneyController::class, 'status'])->name('perfectmoney.status');
Route::post('/coinpayments/status', [CoinpaymentsController::class, 'status'])->name('coinpayments.status');
Route::post('/freekassa/status', [FreeKassaController::class, 'status'])->name('freekassa.status');

Route::get('/translations', [\App\Http\Controllers\Ajax\TranslationController::class, 'getTranslations']);
Route::post('/translations', [\App\Http\Controllers\Ajax\TranslationController::class, 'setTranslations']);

Route::group(['middleware' => ['checkSiteEnabled', 'activity-log', 'http-log']], function () {

    Route::get('/banner/{id}', [ReferralsController::class, 'getBanner'])->name('get.banner');

    Route::post('/ajax/change-lang', [\App\Http\Controllers\Ajax\TranslationController::class, 'changeLang'])->name('ajax.change.lang');
    Route::post('/ajax/get-paysystem-currencies', [ReplenishmentController::class, 'getPaySystemCurrencies'])->name('ajax.paysystem.currencies');

    Route::get('/', [\App\Http\Controllers\CustomerPagesController::class, 'homepage'])->name('customer.main');
    Route::get('/aboutus', [\App\Http\Controllers\CustomerPagesController::class, 'aboutUs'])->name('customer.aboutus');
    Route::get('/documents', [\App\Http\Controllers\CustomerPagesController::class, 'documents'])->name('customer.documents');
    Route::get('/investors', [\App\Http\Controllers\CustomerPagesController::class, 'investors'])->name('customer.investors');
    Route::get('/partners', [\App\Http\Controllers\CustomerPagesController::class, 'partners'])->name('customer.partners');
    Route::get('/contact', [\App\Http\Controllers\CustomerPagesController::class, 'contacts'])->name('customer.contact');
    Route::get('/faq', [\App\Http\Controllers\CustomerPagesController::class, 'faq'])->name('customer.faq');
    Route::get('/agreement', [\App\Http\Controllers\CustomerPagesController::class, 'agreement'])->name('customer.agreement');
    Route::get('/news/{id?}', [\App\Http\Controllers\CustomerPagesController::class, 'news'])->name('customer.news');

    /*Route::get('/payout', [\App\Http\Controllers\Customer\PayoutController::class, 'index'])->name('customer.payout');

    Route::get('/support', [\App\Http\Controllers\Customer\SupportController::class, 'index'])->name('customer.support');
    Route::post('/support', [\App\Http\Controllers\Customer\SupportController::class, 'send'])->name('customer.support');*/

    Route::get('/impersonate/leave', [ImpersonateController::class, 'leave'])->name('impersonate.leave');
    Route::get('/impersonate/{id}', [ImpersonateController::class, 'impersonate'])->name('impersonate');

    // Technical
    Route::get('/lang/{locale}', [\App\Http\Controllers\LanguageController::class, 'index'])->name('set.lang');

    Auth::routes();
    Route::get('/auth/google', [LoginController::class, 'loginWithGoogle'])->name('login.google');

//    Route::get('/login/verify-code', [ProfileController::class, 'verifyLoginCode'])->name('login.verify.code');
    Route::get('/login/enter/verify-code', [ProfileController::class, 'enterVerifyLoginCode'])->name('login.enter.verify.code');
    Route::get('/login/send/verify-code', [ProfileController::class, 'loginSendVerifyCode'])->name('login.send.verify.code');
    Route::post('/login/verify-code', [ProfileController::class, 'verifyCode'])->name('login.verify.code');

    Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout')->name('logout');

    Route::get('/ref/{partner_id}', [SetPartnerController::class, 'index'])->name('ref_link');

    Route::group(['middleware' => ['auth']], function () {
        Route::post('/ajax/set-user-location', [\App\Http\Controllers\Ajax\UserLocationController::class, 'setUserLocationInfo'])->name('ajax.set.user.location');
        Route::post('/ajax/set-user/geoip-table', [\App\Http\Controllers\Ajax\UserLocationController::class, 'setUserGeoipInfo'])->name('ajax.set.user.geoip.table');
        Route::post('/ajax/notification/status/read', [NotificationsController::class, 'setReadStatus'])->name('ajax.notification.status.read');
        Route::post('/ajax/get/rate-min-max', [DepositsController::class, 'getRateMinMax'])->name('ajax.get.rate.min.max');

        Route::any('/payment_message/{status}', [\App\Http\Controllers\PaymentMessageController::class, 'message'])->name('payment_message');

        Route::group(['middleware' => ['2fa', 'checkAuthCode'],  'as' => 'accountPanel.'], function (){

            Route::get('logs', [\Rap2hpoutre\LaravelLogViewer\LogViewerController::class, 'index'])->name('log')->middleware('permission.check');

            Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
            Route::post('/theme-settings', [UserThemeSettingController::class, 'store'])->name('theme-settings');
            Route::post('/dashboard/send-money', [DashboardController::class, 'sendMoney'])->name('dashboard.send.money');
            Route::post('/dashboard/store-user-video', [DashboardController::class, 'storeUserVideo'])->name('dashboard.store.user.video');

            Route::get('/referrals/progress', [ReferralsController::class, 'index'])->name('referrals.progress');
            Route::get('/referrals/banners', [ReferralsController::class, 'banners'])->name('referrals.banners');
            Route::get('/referrals/reftree/{id?}', [ReferralsController::class, 'reftree'])->name('referrals.reftree');
            Route::get('/referrals/tree', [ReferralsController::class, 'treePage'])->name('referrals.tree');



            Route::get('/calendar', [CalendarController::class, 'index'])->name('calendar');

            Route::get('/currency-exchange', [CurrencyController::class, 'showCurrencyExchange'])->name('currency.exchange');
            Route::post('/currency-exchange', [CurrencyController::class, 'currencyExchange'])->name('currency.exchange');
            Route::get('/get_exchange_rate', [CurrencyController::class, 'getExchangeRate'])->name('get_exchange_rate');

            Route::get('/withdrawal', [WithdrawalContoller::class, 'index'])->name('withdrawal');
            Route::post('/withdrawal/add/', [WithdrawalContoller::class, 'addWithdrawal'])->name('withdrawal.add');

            Route::get('/replenishment', [ReplenishmentController::class, 'index'])->name('replenishment');
            Route::post('/replenishment', [ReplenishmentController::class, 'handle'])->name('replenishment');
            //Route::post('/replenishment/new-request', [ReplenishmentController::class, 'newRequest'])->name('replenishment.new.request');
            Route::get('/replenishment/manual/{id?}', [ReplenishmentController::class, 'manual'])->name('replenishment.manual');

            Route::get('/topup/perfectmoney', [PerfectMoneyController::class, 'topUp'])->name('topup.perfectmoney');
            Route::get('/topup/coinpayments', [CoinpaymentsController::class, 'topUp'])->name('topup.coinpayments');
            Route::get('/topup/visa_mastercard', [FreeKassaController::class, 'topUp'])->name('topup.visa_mastercard');

            //Route::get('/profile', [ProfileController::class, 'edit'])->name('profile');
            Route::get('/profile/avatar/{id}', [ProfileController::class, 'getAvatar'])->name('profile.get.avatar');
            Route::post('/profile/update-photo', [ProfileController::class, 'updatePhoto'])->name('profile.update.photo');
            Route::post('/profile/upload-documents', [ProfileController::class, 'uploadDocuments'])->name('profile.upload-documents');

            Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
            Route::post('/profile/wallet-details/update', [ProfileController::class, 'updateWalletDetails'])->name('profile.wallet.details.update');
            Route::get('/settings/security', [AccountSettingsController::class, 'securitySettings'])->name('settings.security');

            Route::get('/settings/profile', [AccountSettingsController::class, 'editProfile'])->name('settings.profile');
            Route::get('/settings/wallets', [AccountSettingsController::class, 'editWallets'])->name('settings.wallets');
            Route::get('/settings/verify', [AccountSettingsController::class, 'verifyAccount'])->name('settings.verify');

            Route::post('/settings/update-phone', [AccountSettingsController::class, 'updatePhone'])->name('settings.update.phone');
            Route::post('/settings/auth-with-phone', [AccountSettingsController::class, 'updateAuthWithPhone'])->name('settings.auth.with.phone');
            Route::get('/settings/enter-verify-code', [AccountSettingsController::class, 'showEnterVerifyCode'])->name('settings.enter.verify.code');
            Route::get('/settings/send-verify-code', [AccountSettingsController::class, 'sendVerifyCode'])->name('settings.send.verify.code');
            Route::post('/settings/verify-phone', [AccountSettingsController::class, 'verifyPhone'])->name('settings.verify.phone');

            Route::get('verify-voice-text-xml/{code}', [AccountSettingsController::class, 'showVerifyVoiceTextXml'])->name('verify.voice.text.xml');

            Route::get('/transactions/{type?}', [TransactionsController::class, 'index'])->name('transactions');
            Route::resource('/deposits', DepositsController::class);
            Route::post('/deposits/set-reinvest', [DepositsController::class, 'setReinvestPercent' ])->name('deposits.set.reinvest');
            Route::post('/deposits/add-balance', [DepositsController::class, 'addBalance' ])->name('deposits.add.balance');
            Route::post('/deposits/upgrade', [DepositsController::class, 'upgrade' ])->name('deposits.upgrade');

            Route::get('/ico', [IsoController::class, 'index' ])->name('ico');

            Route::get('/show', [\App\Http\Controllers\AccountPanel\ShopController::class, 'index' ])->name('shop');

            Route::get('/nft-marketplace', [\App\Http\Controllers\AccountPanel\NftMarketplaceController::class, 'index' ])->name('nft-marketplace');

            Route::post('/set_password', [AccountSettingsController::class, 'setNewPassword'])->name('settings.setPassword');
            Route::post('/set_2fa', [AccountSettingsController::class, 'setNewFFASetting'])->name('settings.set2FA');

            Route::get('/chat/{chat_id?}', [ChatController::class, 'index'])->name('chat');
            Route::post('/chat/send-message', [ChatController::class, 'sendMessage'])->name('chat.send.message');
            Route::post('/chat/read-message', [ChatController::class, 'readMessage'])->name('chat.message.read');

            Route::prefix('support-tasks')->as('support-tasks.')->group(function () {
                Route::get('/', [\App\Http\Controllers\AccountPanel\SupportTaskController::class, 'index'])->name('index');
                Route::get('/create', [\App\Http\Controllers\AccountPanel\SupportTaskController::class, 'create'])->name('create');
                Route::get('/show/{id}', [\App\Http\Controllers\AccountPanel\SupportTaskController::class, 'show'])->name('show');
                Route::post('/store', [\App\Http\Controllers\AccountPanel\SupportTaskController::class, 'store'])->name('store');

                Route::prefix('messages')->as('messages.')->group(function () {
                    Route::post('{id}/store', [\App\Http\Controllers\AccountPanel\SupportTaskMessageController::class, 'store'])->name('store');
                });
            });

            Route::prefix('user-products')->as('user-products.')->group(function () {
                Route::get('/', [\App\Http\Controllers\AccountPanel\UserProductController::class, 'index'])->name('index');
            });

            Route::prefix('products')->as('products.')->group(function () {
                Route::get('/', [\App\Http\Controllers\AccountPanel\ProductController::class, 'index'])->name('index');
                Route::get('/{slug}', [\App\Http\Controllers\AccountPanel\ProductController::class, 'show'])->name('show');
                Route::get('/buy/{slug}', [\App\Http\Controllers\AccountPanel\ProductController::class, 'buy'])->name('buy');
                Route::post('/pay/{id}', [\App\Http\Controllers\AccountPanel\ProductController::class, 'pay'])->name('pay');
            });
        });
    });


    Route::group(['prefix'=>'2fa'], function(){
        Route::get('/', [\App\Http\Controllers\LoginSecurityController::class, 'show2faForm'])->name('2fa');
        Route::post('/generateSecret', [\App\Http\Controllers\LoginSecurityController::class, 'generate2faSecret'])->name('generate2faSecret');
        Route::post('/enable2fa', [\App\Http\Controllers\LoginSecurityController::class, 'enable2fa'])->name('enable2fa');
        Route::post('/disable2fa', [\App\Http\Controllers\LoginSecurityController::class, 'disable2fa'])->name('disable2fa');

        // 2fa middleware
        Route::post('/2faVerify', function () {
            return redirect(URL()->previous());
        })->name('2faVerify')->middleware('2fa');
    });

});

Route::get('site-disabled', function () {
    if (\App\Models\Setting::getValue('disable_client_site', '', true) == 'false') {
        return redirect()->to('/');
    }
    return view('site-disabled');
})->name('site-disabled');

// test middleware
Route::get('/test_middleware', function () {
    return "2FA middleware work!";
})->middleware(['auth', '2fa']);
