<?php

namespace App\Console\Commands;

use App\Models\Currency;
use App\Models\Deposit;
use App\Models\User;
use App\Models\UserDepositBonus;
use App\Models\Wallet;
use Illuminate\Console\Command;

class CalculateReferralsTotalInvestedAndPersonalTurnover extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'calculate:invested-total-and-turnover';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Calculate invested total by referrals for each user';

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
        \Log::critical('CalculateReferralsTurnover start');

        $userDepositBonusesExists = (bool)UserDepositBonus::count();
        $usdCurrency = Currency::where('code', 'USD')->first();

        /** @var User $user */
        foreach (User::orderBy('referrals_invested_total', 'desc')->get() as $user) {
            $all_referrals = $user->getAllReferralsInArray(1, 9);
            $total_referral_invested = 0;
            $referrals_count = 0;

            foreach ($all_referrals as $referral) {
                $referral
                    ->deposits()
                    ->where('active', 1)
                    ->get()
                    ->each(function (Deposit $deposit) use (&$total_referral_invested, $usdCurrency) {
                        $total_referral_invested += (new Wallet())->convertToCurrency($deposit->currency, $usdCurrency, $deposit->balance);
                    });

                $referrals_count += $referral->deposits()
                    ->where('active', 1)
                    ->count() > 0 ? 1 : 0;
            }
            $personal_turnover = 0;
            $user->deposits()
                ->where('active', 1)
                ->get()
                ->each(function(Deposit $deposit) use(&$personal_turnover, $usdCurrency) {
                    $personal_turnover += (new Wallet())->convertToCurrency($deposit->currency, $usdCurrency, $deposit->balance);
                });
            $user->update([
                'referrals_invested_total' => $total_referral_invested,
                'personal_turnover' => $personal_turnover,
                'total_referrals_count' => $referrals_count
            ]);

            foreach ($user->userDepositBonuses()->where('delayed', true)->get() as $depositBonus) {
                if (now()->diffInHours($depositBonus->created_at) >= 24) {
                    if (UserDepositBonus::addBonusToUserWallet($user, $depositBonus->deposit_bonus_reward)) {
                        $depositBonus->update([
                            'delayed' => false
                        ]);
                    }
                }
            }

            UserDepositBonus::setUserBonuses($user, $userDepositBonusesExists);
        }

        \Log::critical('CalculateReferralsTurnover finish');
        return Command::SUCCESS;
    }
}
