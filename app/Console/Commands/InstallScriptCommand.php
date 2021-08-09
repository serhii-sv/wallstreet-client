<?php
/**
 * Copyright. "NewGen" investment engine. All rights reserved.
 * Any questions? Please, visit https://newgen.company
 */

namespace App\Console\Commands;

use Illuminate\Console\Command;

/**
 * Class InstallScriptCommand
 * @package App\Console\Commands
 */
class InstallScriptCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Installing script data';

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
     * @return mixed
     */
    public function handle()
    {
        $this->info('Clear cache:');
        $this->call('cache:clear');

        $this->line('===================================');

        $this->info('Generating APP KEY:');
        $this->call('key:generate');

        $this->line('===================================');

        $this->info('Migrations:');
        $this->call('migrate');

        $this->line('===================================');

        $this->info('DB seeds:');
        $this->call('db:seed');

        $this->line('===================================');

        $this->info('Registering currencies:');
        $this->call('register:currencies');

        $this->line('===================================');

        $this->info('Registering payment systems:');
        $this->call('register:payment_systems');

        $this->line('===================================');

        $this->info('Registering root user:');
        $this->call('make:root');

        $this->line('===================================');
        $needDemoData = $this->ask('Do you need demo data? [yes|no]', false);

        if ($needDemoData == 'yes') {
            $this->call('generate:demo_data');
        }
    }
}
