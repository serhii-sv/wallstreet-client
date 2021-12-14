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

            cache()->forget('referrals.array.' . $user->id);

            if (cache()->has('referrals.array.' . $user->id)) {
                cache()->put('referrals.array.' . $user->id, $user->getAllReferralsInArray());
                $all_referrals = cache()->get('referrals.array.' . $user->id);
            }

            if (!empty($all_referrals)) {
                foreach ($all_referrals as $referral) {
                    $referral = User::find($referral->id);
                    cache()->forget('us.referrals.' . $referral->id);
                    if (cache()->has('us.referrals.' . $referral->id)) {
                        cache()->put('us.referrals.' . $referral->id, $referral->getAllReferrals(false, 1, 1));
                    }
                }
            }

            cache()->forget('us.referrals.' . $user->id);
            if (cache()->has('us.referrals.' . $user->id)) {
                cache()->put('us.referrals.' . $user->id, $user->getAllReferrals(false, 1, 1));
            }
        }
        return Command::SUCCESS;
    }
}
