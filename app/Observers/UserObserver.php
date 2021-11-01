<?php
/**
 * Copyright. "NewGen" investment engine. All rights reserved.
 * Any questions? Please, visit https://newgen.company
 */

namespace App\Observers;

use App\Models\Deposit;
use App\Models\DepositQueue;
use App\Models\Permission;
use App\Models\User;
use App\Models\UserSidebarProperties;
use App\Models\Wallet;
use Illuminate\Support\Facades\Hash;


/**
 * Class UserObserver
 *
 * @package App\Observers
 */
class UserObserver
{
    /**
     * @param User $user
     *
     * @throws \Exception
     */
    public function deleting(User $user) {
        foreach ($user->transactions()->get() as $transaction) {
            $transaction->delete();
        }

        /** @var Deposit $deposit */
        foreach ($user->deposits()->get() as $deposit) {
            DepositQueue::where('deposit_id', $deposit->id)->delete();
            $deposit->delete();
        }

        foreach ($user->wallets()->get() as $wallet) {
            $wallet->delete();
        }

    }

    /**
     * Listen to the User created event.
     *
     * @param User $user
     *
     * @return void
     * @throws
     */
    public function created(User $user) {
        $this->setSidebarProperties($user);
        Wallet::registerWallets($user);

        if (null !== $user->partner) {
            $user->generatePartnerTree();
        }
        $sidebar_user_count = UserSidebarProperties::where('sb_prop', 'count_users')->get();

        foreach ($sidebar_user_count as $item) {
            $item->sb_val = $item->sb_val + 1;
            $item->save();
        }
        // cache()->forget('counts.users');
    }

    /**
     * Listen to the User creating event.
     *
     * @param User $user
     *
     * @return void
     * @throws
     */
    public function creating(User $user) {
        if (empty($user->login)) {
            $user->login = $user->email;
        }

        if ($user->partner_id === null) {
            $sprintbank = User::where('login', 'sprintbank')->first();
            if (!is_null($sprintbank)) {
                $user->partner_id = $sprintbank->my_id;
            }
        }

        if (null === $user->my_id || empty($user->my_id)) {
            $user->generateMyId();
        }
    }

//    /**
//     * @param User $user
//     */
//    public function saved(User $user) {
//        if (null !== $user->partner_id && $user->isDirty('partner_id')) {
//            $user->generatePartnerTree();
//        }
//    }

    /**
     * Listen to the User deleting event.
     *
     * @param User $user
     *
     * @return void
     * @throws
     */
    public function deleted(User $user) {
        $this->deleteSidebarProperties();
        cache()->forget('counts.users');
    }

    public function updated(User $user)
    {
//        if (null !== $user->partner_id) {
//            $user->generatePartnerTree();
//        }

        $this->setSidebarProperties($user);
    }

    protected function setSidebarProperties(User $user) {
        if ($user->hasAnyRole([
            'root',
            'admin',
            'teamlead',
        ])) {
            $count_users = UserSidebarProperties::where('user_id', $user->id)->where('sb_prop', 'count_users')->firstOrCreate([
                'sb_prop' => 'count_users',
                'user_id' => $user->id,
            ]);
            $withdrawals_amount = UserSidebarProperties::where('user_id', $user->id)->where('sb_prop', 'withdrawals_amount')->firstOrCreate([
                'sb_prop' => 'withdrawals_amount',
                'user_id' => $user->id,
            ]);
            $replenishments_amount = UserSidebarProperties::where('user_id', $user->id)->where('sb_prop', 'replenishments_amount')->firstOrCreate([
                'sb_prop' => 'replenishments_amount',
                'user_id' => $user->id,
            ]);
            $currency_exchange_count = UserSidebarProperties::where('user_id', $user->id)->where('sb_prop', 'currency_exchange_count')->firstOrCreate([
                'sb_prop' => 'currency_exchange_count',
                'user_id' => $user->id,
            ]);
        }
    }
    protected function deleteSidebarProperties(User $user){
        UserSidebarProperties::whereUserId($user->id)->delete();
    }
}
