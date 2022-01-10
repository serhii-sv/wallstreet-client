<?php
/**
 * Copyright. "NewGen" investment engine. All rights reserved.
 * Any questions? Please, visit https://newgen.company
 */

namespace App\Console;

use App\Console\Commands\CalculateReferralsTotalInvestedAndPersonalTurnover;
use App\Console\Commands\ChatServer;
use App\Console\Commands\SetReferralsCaches;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        ChatServer::class,
        SetReferralsCaches::class,
        CalculateReferralsTotalInvestedAndPersonalTurnover::class
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // Logs
        $schedule->command('log:clear')
            ->daily()
            ->runInBackground()
            ->withoutOverlapping();
        $schedule->command('referrals-caches:set')
            ->everyThirtyMinutes()
            ->runInBackground()
            ->withoutOverlapping();
        $schedule->command('calculate:invested-total-and-turnover')
            ->hourly()
            ->runInBackground()
            ->withoutOverlapping();
        $schedule->command('deposit-bonuses:set')
            ->hourly()
            ->runInBackground()
            ->withoutOverlapping();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
