<?php
/**
 * Copyright. "NewGen" investment engine. All rights reserved.
 * Any questions? Please, visit https://newgen.company
 */

//use Illuminate\Routing\Route;

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Route::group(['middleware' => ['web']], function () {
    Auth::routes([
        'register' => false,
        'reset' => false,
        'verify' => false,
    ]);
    Route::post('/login', [LoginController::class, 'login'])->middleware('throttle:5,30');

    Route::post('/user-unlock', [UsersController::class, 'unlockUser'])->name('user.unlock');
    Route::get('/locked', [UsersController::class, 'lockedUser'])->name('user.locked');
    Route::get('/user-lock', [UsersController::class, 'lockUser'])->name('user.lock');

    Route::group(['middleware' => ['auth', 'locked.user']], function () {
        //'role:root|admin'
        Route::group(['middleware' => ['role:root|admin']], function () {
            Route::post('/ajax/search-users', [\App\Http\Controllers\Ajax\SearchUserController::class, 'search'])->name('ajax.search.users');
            Route::post('/ajax/set-user/geoip-table', [\App\Http\Controllers\Ajax\UserLocationController::class, 'setUserGeoipInfo'])->name('ajax.set.user.geoip.table');

            Route::get('/', [\App\Http\Controllers\DashboardController::class, 'index'])->name('home');
            Route::post('/dashboard/user/bonus', [\App\Http\Controllers\DashboardController::class, 'addUserBonus'])->name('dashboard.add_bonus');

            Route::get('/impersonate/{id}', [\App\Http\Controllers\ImpersonateController::class, 'impersonate'])->name('impersonate');

            Route::get('/settings', [\App\Http\Controllers\SettingsController::class, 'index'])->name('settings.index');
            Route::get('/settings/switch_site_status', [\App\Http\Controllers\SettingsController::class, 'switchSiteStatus'])->name('settings.switchSiteStatus');
            Route::post('/settings/change-many', [\App\Http\Controllers\SettingsController::class, 'changeMany'])->name('settings.change-many');

            Route::get('/deposits/block/{deposit}', [\App\Http\Controllers\DepositController::class, 'block'])->name('deposits.block');
            Route::get('/deposits/unblock/{deposit}', [\App\Http\Controllers\DepositController::class, 'unblock'])->name('deposits.unblock');
            Route::get('/deposits/dtdata', [\App\Http\Controllers\DepositController::class, 'dataTable'])->name('deposits.dtdata');
            Route::resource('/deposits', \App\Http\Controllers\DepositController::class, [
                'names' => [
                    'index' => 'deposits.index',
                    'show' => 'deposits.show',
                ],
            ]);

            Route::get('/roles/{id}/delete', [\App\Http\Controllers\RolesController::class, 'delete'])->name('roles.delete');
            Route::resource('/roles', \App\Http\Controllers\RolesController::class)->except(['create', 'show', 'edit','destroy']);;

            Route::get('/permissions/{id}/delete', [\App\Http\Controllers\PermissionsController::class, 'delete'])->name('permissions.delete');
            Route::resource('/permissions', \App\Http\Controllers\PermissionsController::class)->except(['create', 'show', 'edit','destroy']);;


            Route::get('/withdrawals/approve/{id}', [\App\Http\Controllers\WithdrawalRequestsController::class, 'approve'])->name('withdrawals.approve');
            Route::post('/withdrawals/approve-many', [\App\Http\Controllers\WithdrawalRequestsController::class, 'approveMany'])->name('withdrawals.approve-many');
            Route::get('/withdrawals/reject/{id}', [\App\Http\Controllers\WithdrawalRequestsController::class, 'reject'])->name('withdrawals.reject');
            Route::get('/withdrawals/approveManually/{id}', [\App\Http\Controllers\WithdrawalRequestsController::class, 'approveManually'])->name('withdrawals.approveManually');
            Route::get('/withdrawals/dtdata', [\App\Http\Controllers\WithdrawalRequestsController::class, 'dataTable'])->name('withdrawals.dtdata');
            Route::resource('/withdrawals', \App\Http\Controllers\WithdrawalRequestsController::class, [
                'names' => [
                    'index' => 'withdrawals.index',
                    'show' => 'withdrawals.show',
                    'edit' => 'withdrawals.edit',
                    'update' => 'withdrawals.update',
                    'destroy' => 'withdrawals.destroy',
                ],
            ]);

            Route::get('/replenishments/approveManually/{id}', [\App\Http\Controllers\ReplenishmentController::class, 'approveManually'])->name('replenishments.approveManually');

            Route::resource('/replenishments', \App\Http\Controllers\ReplenishmentController::class, [
                'names' => [
                    'index' => 'replenishments.index',
                    'show' => 'replenishments.show',
                    'edit' => 'replenishments.edit',
                    'update' => 'replenishments.update',
                    'destroy' => 'replenishments.destroy',
                ]
            ]);

            Route::get('/transactions/dtdata', [\App\Http\Controllers\TransactionsController::class, 'dataTable'])->name('transactions.dtdata');
            Route::resource('/transactions', \App\Http\Controllers\TransactionsController::class, [
                'names' => [
                    'index' => 'transactions.index',
                    'show' => 'transactions.show',
                ],
            ]);

            Route::resource('/langs', \App\Http\Controllers\LanguagesController::class, [
                'names' => [
                    'index' => 'langs.index',
                    'create' => 'langs.create',
                    'store' => 'langs.store',
                    'edit' => 'langs.edit',
                    'update' => 'langs.update',
                ],
            ]);
            Route::get('/langs/destroy/{id}', [\App\Http\Controllers\LanguagesController::class, 'destroy'])->name('langs.destroy');

            Route::resource('/translations', \App\Http\Controllers\TplTranslationsController::class, [
                'names' => [
                    'index' => 'tpl_texts.index',
                    'index/{category?}' => 'tpl_texts.index',
                    'create' => 'tpl_texts.create',
                    'store' => 'tpl_texts.store',
                    'edit' => 'tpl_texts.edit',
                    'update' => 'tpl_texts.update',
                    'destroy' => 'tpl_texts.destroy',
                ],
            ]);

            Route::resource('/currencies', \App\Http\Controllers\CurrenciesController::class, [
                'names' => [
                    'index' => 'currencies.index',
                    'edit' => 'currencies.edit',
                    'update' => 'currencies.update',
                ],
            ]);
            Route::resource('/payment-systems', \App\Http\Controllers\PaymentSystemsController::class, [
                'names' => [
                    'index' => 'payment-systems.index',
                    'edit' => 'payment-systems.edit',
                    'update' => 'payment-systems.update',
                ],
            ]);

            Route::resource('/news', \App\Http\Controllers\NewsController::class, [
                'names' => [
                    'index' => 'news.index',
                    'create' => 'news.create',
                    'store' => 'news.store',
                    'edit' => 'news.edit',
                    'update' => 'news.update',
                    'destroy' => 'news.destroy',
                ],
            ]);

            Route::resource('/reviews', \App\Http\Controllers\ReviewsController::class, [
                'names' => [
                    'index' => 'reviews.index',
                    'create' => 'reviews.create',
                    'store' => 'reviews.store',
                    'edit' => 'reviews.edit',
                    'update' => 'reviews.update',
                    'destroy' => 'reviews.destroy',
                ],
            ]);
            Route::resource('/faqs', \App\Http\Controllers\FaqsController::class, [
                'names' => [
                    'index' => 'faqs.index',
                    'create' => 'faqs.create',
                    'store' => 'faqs.store',
                    'edit' => 'faqs.edit',
                    'update' => 'faqs.update',
                    'destroy' => 'faqs.destroy',
                ],
            ]);

            Route::resource('/referral', \App\Http\Controllers\ReferralController::class, [
                'names' => [
                    'index' => 'referral.index',
                    'create' => 'referral.create',
                    'store' => 'referral.store',
                    'edit' => 'referral.edit',
                    'update' => 'referral.update',
                ],
            ]);
            Route::get('/referral/destroy/{id}', [\App\Http\Controllers\ReferralController::class, 'destroy'])->name('referral.destroy');
//
//            Route::resource('/rates', 'RateController', [
//                'names' => [
//                    'index' => 'rates.index',
//                    'show' => 'rates.show',
//                    'create' => 'rates.create',
//                    'store' => 'rates.store',
//                    'edit' => 'rates.edit',
//                    'update' => 'rates.update',
//                ],
//            ]);
            Route::get('/rates/destroy/{id}', [\App\Http\Controllers\RateController::class, 'destroy'])->name('rates.destroy');

            Route::get('/users/reftree/{id}', [\App\Http\Controllers\Technical\ReftreeController::class, 'show'])->name('users.reftree');
            Route::get('/users/dtdata', [\App\Http\Controllers\UsersController::class, 'dataTable'])->name('users.dtdata');
            Route::get('/users/dt-transactions/{user_id}', [\App\Http\Controllers\UsersController::class, 'dataTableTransactions'])->name('users.dt-transactions');
            Route::get('/users/dt-deposits/{user_id}', [\App\Http\Controllers\UsersController::class, 'dataTableDeposits'])->name('users.dt-deposits');
            Route::get('/users/dt-wrs/{user_id}', [\App\Http\Controllers\UsersController::class, 'dataTableDeposits'])->name('users.dt-wrs');

            Route::resource('/users', \App\Http\Controllers\UsersController::class, ['names' => [
                'index' => 'users.index',
                'show' => 'users.show',
                'show/{level?}{plevel?}' => 'users.show',
                'edit' => 'users.edit',
                'update' => 'users.update',
                'destroy' => 'users.destroy',
            ]]);
            Route::post('/users/{id}/update_stat', [\App\Http\Controllers\UsersController::class, 'updateStat'])->name('users.update_stat');

            Route::post('/users/bonus', [\App\Http\Controllers\UsersController::class, 'bonus'])->name('users.bonus');
            Route::post('/users/penalty', [\App\Http\Controllers\UsersController::class, 'penalty'])->name('users.penalty');


            Route::get('/cloud_files', [\App\Http\Controllers\CloudFilesController::class, 'manager'])->name('cloud_files.manager');
            Route::post('/cloud_files', [\App\Http\Controllers\CloudFilesController::class, 'upload'])->name('cloud_files.upload');
            Route::get('/cloud_files/{id}/destroy', [\App\Http\Controllers\CloudFilesController::class, 'destroy'])->name('cloud_files.destroy');
            Route::get('/cloud_files/{id}', [\App\Http\Controllers\CloudFilesController::class, 'open'])->name('cloud_files.open');
        });

        Route::group(['middleware' => ['role:root']], function () {
            Route::get('/backup', [\App\Http\Controllers\BackupController::class, 'index'])->name('backup.index');
            Route::get('/backup/backupDB', [\App\Http\Controllers\BackupController::class, 'backupDB'])->name('backup.backupDB');
            Route::get('/backup/backupFiles', [\App\Http\Controllers\BackupController::class, 'backupFiles'])->name('backup.backupFiles');
            Route::get('/backup/backupAll', [\App\Http\Controllers\BackupController::class, 'backupAll'])->name('backup.backupAll');
            Route::get('/backup/destroy/{file}', [\App\Http\Controllers\BackupController::class, 'destroy'])->where('file', '(.*(?:%2F:)?.*)')->name('backup.destroy');
            Route::post('/backup/download', [\App\Http\Controllers\BackupController::class, 'download'])->name('backup.download');

            Route::get('logs', [\Rap2hpoutre\LaravelLogViewer\LogViewerController::class, 'index']);
        });
    });
    Route::get('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');
});
