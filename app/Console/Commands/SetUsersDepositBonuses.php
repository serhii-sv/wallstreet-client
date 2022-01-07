<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Models\UserDepositBonus;
use Illuminate\Console\Command;

class SetUsersDepositBonuses extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'deposit-bonuses:set';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        foreach (User::all() as $user) {
            UserDepositBonus::setUserBonuses($user);
        }
        return Command::SUCCESS;
    }
}
