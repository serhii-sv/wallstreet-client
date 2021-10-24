<?php
/**
 * Copyright. "NewGen" investment engine. All rights reserved.
 * Any questions? Please, visit https://newgen.company
 */

namespace App\Observers;

use App\Models\Deposit;
use App\Models\DepositQueue;
use App\Models\User;
use App\Models\UserSidebarProperties;
use App\Models\Wallet;

/**
 * Class UserObserver
 * @package App\Observers
 */
class UserObserver
{
    /**
     * @param User $user
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
     * @return void
     * @throws
     */
    public function created(User $user)
    {
        Wallet::registerWallets($user);

        if (null !== $user->partner) {
            $user->generatePartnerTree($user->partner);
        }
        $sidebar_user_count = UserSidebarProperties::where('sb_prop','count_users')->get();

        foreach ($sidebar_user_count as $item){
            $item->sb_val = $item->sb_val + 1;
            $item->save();
        }
        //cache()->forget('counts.users');
    }

    /**
     * Listen to the User creating event.
     *
     * @param User $user
     * @return void
     * @throws
     */
    public function creating(User $user)
    {
        if (empty($user->login)) {
            $user->login = $user->email;
        }
        if (null === $user->my_id || empty($user->my_id)) {
            $user->generateMyId();
        }
    }

    /**
     * @param User $user
     */
    public function saved(User $user)
    {

    }

    /**
     * Listen to the User deleting event.
     *
     * @param User $user
     * @return void
     * @throws
     */
    public function deleted(User $user)
    {
        cache()->forget('counts.users');
    }
}
