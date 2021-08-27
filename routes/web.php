<?php
/**
 * Copyright. "NewGen" investment engine. All rights reserved.
 * Any questions? Please, visit https://newgen.company
 */

//use Illuminate\Routing\Route;

use App\Http\Controllers\AccountPanel\AccountSettingsController;
use App\Http\Controllers\AccountPanel\DepositsController;
use App\Http\Controllers\AccountPanel\DashboardController;
use App\Http\Controllers\AccountPanel\ProfileController;
use App\Http\Controllers\AccountPanel\ReferralsController;
use App\Http\Controllers\AccountPanel\TransactionsController;
use App\Http\Controllers\AccountPanel\WithdrawalContoller;
use App\Http\Controllers\Ajax\NotificationsController;
use App\Http\Controllers\Ajax\UserThemeSettingController;
use App\Http\Controllers\ChatController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::post('/ajax/change-lang', [\App\Http\Controllers\Ajax\TranslationController::class, 'changeLang'])->name('ajax.change.lang');

Route::get('/', [\App\Http\Controllers\CustomerPagesController::class, 'homepage'])->name('customer.main');
Route::get('/aboutus', [\App\Http\Controllers\CustomerPagesController::class, 'aboutUs'])->name('customer.aboutus');
Route::get('/documents', [\App\Http\Controllers\CustomerPagesController::class, 'documents'])->name('customer.documents');
Route::get('/investors', [\App\Http\Controllers\CustomerPagesController::class, 'investors'])->name('customer.investors');
Route::get('/partners', [\App\Http\Controllers\CustomerPagesController::class, 'partners'])->name('customer.partners');
Route::get('/contact', [\App\Http\Controllers\CustomerPagesController::class, 'contacts'])->name('customer.contact');
Route::get('/faq', [\App\Http\Controllers\CustomerPagesController::class, 'faq'])->name('customer.faq');
Route::get('/agreement', [\App\Http\Controllers\CustomerPagesController::class, 'agreement'])->name('customer.agreement');

/*Route::get('/payout', [\App\Http\Controllers\Customer\PayoutController::class, 'index'])->name('customer.payout');

Route::get('/support', [\App\Http\Controllers\Customer\SupportController::class, 'index'])->name('customer.support');
Route::post('/support', [\App\Http\Controllers\Customer\SupportController::class, 'send'])->name('customer.support');*/



// Technical
Route::get('/lang/{locale}', [\App\Http\Controllers\LanguageController::class, 'index'])->name('set.lang');

Auth::routes();

Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout')->name('logout');



Route::group(['middleware' => ['auth']], function () {
    Route::post('/ajax/set-user-location', [\App\Http\Controllers\Ajax\UserLocationController::class, 'setUserLocationInfo'])->name('ajax.set.user.location');
    Route::post('/ajax/set-user/geoip-table', [\App\Http\Controllers\Ajax\UserLocationController::class, 'setUserGeoipInfo'])->name('ajax.set.user.geoip.table');
    Route::post('/ajax/notification/status/read', [NotificationsController::class, 'setReadStatus'])->name('ajax.notification.status.read');
    Route::post('/theme-settings', [UserThemeSettingController::class, 'store'])->name('theme-settings');
    
    Route::group(['middleware' => ['2fa'],  'as' => 'accountPanel.'], function (){
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::post('/dashboard/send-money', [DashboardController::class, 'sendMoney'])->name('dashboard.send.money');
        Route::post('/dashboard/store-user-video', [DashboardController::class, 'storeUserVideo'])->name('dashboard.store.user.video');
    
        Route::get('/referrals', [ReferralsController::class, 'index'])->name('referrals');
        
        Route::get('/Withdrawal', [WithdrawalContoller::class, 'index'])->name('withdrawal');
        Route::post('/Withdrawal/add/', [WithdrawalContoller::class, 'addWithdrawal'])->name('withdrawal.add');
        
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile');
        Route::get('/profile/avatar/{id}', [ProfileController::class, 'getAvatar'])->name('profile.get.avatar');
        Route::post('/profile/update-photo', [ProfileController::class, 'updatePhoto'])->name('profile.update.photo');
        Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
        Route::get('/settings/security', [AccountSettingsController::class, 'securitySettings'])->name('settings.security');
    
        Route::get('/transactions', [TransactionsController::class, 'index'])->name('transactions');
        Route::resource('/deposits', DepositsController::class);
    
        Route::post('/set_password', [AccountSettingsController::class, 'setNewPassword'])->name('settings.setPassword');
        Route::post('/set_2fa', [AccountSettingsController::class, 'setNewFFASetting'])->name('settings.set2FA');
        
        Route::get('/chat/{chat_id?}', [ChatController::class, 'index'])->name('chat');
        Route::get('/message/send', [ChatController::class, 'send']);
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

// test middleware
Route::get('/test_middleware', function () {
    return "2FA middleware work!";
})->middleware(['auth', '2fa']);
