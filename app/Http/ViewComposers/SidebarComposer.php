<?php

namespace App\Http\ViewComposers;

use App\Models\CloudFile;
use App\Models\Transaction;
use App\Models\TransactionType;
use App\Models\User;
use DateTime;
use Illuminate\Support\Carbon;
use Illuminate\View\View;

class SidebarComposer
{
    public function __construct()
    {
        //
    }

    /**
     * Bind data to the view.
     *
     * @param View $view
     * @return void
     */
    public function compose(View $view)
    {
        $view
            ->with('counts', [
                'users' => cache()->remember('counts.users', now()->addHour(), function() {
                    return \App\User::count();
                }),
                'files' => cache()->remember('counts.files', now()->addHour(), function() {
                    return CloudFile::count();
                }),
                'withdrawals_amount' => cache()->remember('counts.withdrawals_amount', now()->addHour(), function() {
                    $sum = Transaction::where('approved', 0)->where('type_id', TransactionType::getByName('withdraw')->id)->sum('main_currency_amount');
                    return Transaction::sidebarIndicatorsFormatting($sum);
                }),
                'replenishments_amount' => cache()->remember('counts.replenishments_amount', now()->addHour(), function() {
                    $sum = Transaction::where('approved', 1)->where('type_id', TransactionType::getByName('enter')->id)->sum('main_currency_amount');
                    return Transaction::sidebarIndicatorsFormatting($sum);
                }),
                'transactions_amount' => cache()->remember('counts.transactions_amount', now()->addHour(), function() {
                    $sum = Transaction::sum('main_currency_amount');
                    return Transaction::sidebarIndicatorsFormatting($sum);
                })

            ]);

    }
}
