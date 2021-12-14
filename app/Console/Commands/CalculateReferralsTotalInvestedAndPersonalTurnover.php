<?php

namespace App\Console\Commands;

use App\Models\Currency;
use App\Models\Deposit;
use App\Models\User;
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
        $usdCurrency = Currency::where('code', 'USD')->first();

        foreach (User::all() as $user) {
            $all_referrals = $user->getAllReferralsInArray();
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
        }
        return Command::SUCCESS;
    }
}
