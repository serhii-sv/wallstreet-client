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
    protected $signature = 'deposit-bonuses:set{login?}';

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
        $login = $this->argument('login');
        $this->info('bonuses for '.$login ?? 'all');

        $users = User::where(null);

        if (!empty($login)) {
            $users = $users->where('login', $login);
        }

        $users->get();

        /** @var User $user */
        foreach ($users as $user) {
            $this->info('work with user '. $user->login);
            UserDepositBonus::setUserBonuses($user);
        }
        return Command::SUCCESS;
    }
}
