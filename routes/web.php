<?php
/**
 * Copyright. "NewGen" investment engine. All rights reserved.
 * Any questions? Please, visit https://newgen.company
 */

//use Illuminate\Routing\Route;

use App\Http\Controllers\AccountPanel\AccountSettingsController;
use App\Http\Controllers\AccountPanel\DashboardController;
use App\Http\Controllers\AccountPanel\TransactionsController;
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

Route::group(['middleware' => ['auth', '2fa']], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('accountPanel.dashboard');

    Route::get('/settings/security', [AccountSettingsController::class, 'securitySettings'])->name('accountPanel.settings.security');

    Route::get('/transactions', [TransactionsController::class, 'index'])->name('accountPanel.transactions');

    Route::post('/set_password', [AccountSettingsController::class, 'setNewPassword'])->name('accountPanel.settings.setPassword');
    Route::post('/set_2fa', [AccountSettingsController::class, 'setNewFFASetting'])->name('accountPanel.settings.set2FA');

    Route::post('/ajax/set-user-location', [\App\Http\Controllers\Ajax\UserLocationController::class, 'setUserLocationInfo'])->name('ajax.set.user.location');
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
