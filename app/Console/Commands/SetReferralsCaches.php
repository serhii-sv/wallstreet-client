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
        /** @var User $user */
        foreach (User::orderBy('referrals_invested_total', 'asc')->get() as $user) {
            $this->info('work with user '.$user->login);

//            cache()->forget('referrals.array.' . $user->id);
            cache()->put('referrals.array.' . $user->id, $user->getAllReferralsInArray(), now()->addHours(3));
            $all_referrals = cache()->get('referrals.array.' . $user->id);

            cache()->remember('reftree.'.$user->id, now()->addHours(3), function() use ($user) {
                return $this->getChildrens($user, 7);
            });

            cache()->remember('partner_name.'.$user->id, now()->addHours(3), function() use ($user) {
                return $user->partner->name ?? 'undefined';
            });

            if (!empty($all_referrals)) {
                foreach ($all_referrals as $referral) {
                    if (is_array($referral)) {
                        $this->warn('is array');
                        continue 2;
                    }

                    /** @var User $referral */
                    $referral = User::find($referral->id);

                    $invested = $referral->invested();
                    $this->info('invested '.$invested);

                    $referralAccruals = $referral->referral_accruals($user);
                    $this->info('referral accruals '.$referralAccruals);

                    $depositAccruals = $referral->deposits_accruals();
                    $this->info('deposit accruals '.$depositAccruals);

                    $this->comment('work with ref '.$referral->login);
//                    cache()->forget('us.referrals.' . $referral->id);
                    cache()->put('us.referrals.' . $referral->id, $referral->getAllReferrals(false, 1, 1), now()->addHours(3));
                    $this->info('referrals count '.count(cache()->get('us.referrals.' . $referral->id)['referrals'] ?? []));
                }
            }

            $this->info('get referrals for '.$user->login);
//            cache()->forget('us.referrals.' . $user->id);
            cache()->put('us.referrals.' . $user->id, $user->getAllReferrals(false, 1, 1), now()->addHours(3));
            $this->info('us referrals count '.count(cache()->get('us.referrals.' . $user->id)['referrals'] ?? []));
        }

        return Command::SUCCESS;
    }

    /**
     * @param User $user
     * @param int $limit
     * @return array
     */
    private function getChildrens(User $user, $limit = 3) {
        if ($limit === 0) {
            return [];
        }
        if (empty($user)) {
            return [];
        }

        $referrals = [];
        $referrals['name'] = $user->login;
        if (!$user->hasReferrals()) {
            return $referrals;
        }

        foreach ($user->referrals()->wherePivot('line', 1)->get() as $r) {
            $referral = $this->getChildrens($r, $limit - 1);
            $referrals['children'][] = $referral;
        }
        return $referrals;
    }
}
