<?php
/**
 * Copyright. "NewGen" investment engine. All rights reserved.
 * Any questions? Please, visit https://newgen.company
 */

namespace App\Console;

use App\Console\Commands\CheckPaymentSystemsConnectionsCommand;
use App\Console\Commands\CreateAdminCommand;
use App\Console\Commands\DepositQueueCommand;
use App\Console\Commands\GenerateDemoDataCommand;
use App\Console\Commands\CreateRootCommand;
use App\Console\Commands\InstallScriptCommand;
use App\Console\Commands\RegisterCurrenciesCommand;
use App\Console\Commands\RegisterPaymentSystemsCommand;
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
        $schedule->command('log:clear')->daily()->withoutOverlapping();

        // Jobs
        $schedule->command('horizon:snapshot')->everyFiveMinutes();

        // Financial
        $schedule->command('check:payment_systems_connections')->everyTenMinutes()->withoutOverlapping();
        $schedule->command('deposits:queue')->everyTenMinutes()->withoutOverlapping();
        $schedule->command('update:currency_rates')->twiceDaily()->withoutOverlapping();

        // Backups
        $schedule->command('backup:clean')->hourly();
        $schedule->command('backup:run', ['--only-db'])->hourly();
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
