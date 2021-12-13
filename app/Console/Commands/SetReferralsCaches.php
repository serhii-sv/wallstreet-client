<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class SetReferralsCaches extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'referrals-caches:set';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update some referrals caches';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        foreach (User::all() as $user) {
            $all_referrals = [];
            if (cache()->has('referrals.array.' . $user->id)) {
                $all_referrals = cache()->rememberForever('referrals.array.' . $user->id, function () use ($user) {
                    return $user->getAllReferralsInArray();
                });
            }

            $total_referrals = 0;
            foreach ($all_referrals as $referral) {
                if (cache()->has('referrals.active_referral.' . $referral->id)) {
                    $total_referrals += cache()->rememberForever('referrals.active_referral.' . $referral->id, function () use ($referral) {
                        return $referral->deposits()
                            ->where('active', 1)
                            ->count() > 0 ? 1 : 0;
                    });
                }

                $referral = User::find($referral->id);
                if (cache()->has('us.referrals.' . $referral->id)) {
                    cache()->rememberForever('us.referrals.' . $referral->id, function () use ($referral) {
                        return $referral->getAllReferrals(false, 1, 1);
                    });
                }
            }
            if (cache()->has('us.referrals.' . $user->id)) {
                cache()->rememberForever('us.referrals.' . $user->id, function () use ($user) {
                    return $user->getAllReferrals(false, 1, 1);
                });
            }
        }
        return Command::SUCCESS;
    }
}
