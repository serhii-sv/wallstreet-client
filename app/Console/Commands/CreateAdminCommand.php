<?php

namespace App\Console\Commands;

use Faker\Factory;
use Illuminate\Console\Command;

class CreateAdminCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:admin {demo?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creating admin user';

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
        $this->line('------');
    
        $faker = Factory::create();
    
        $name = $faker->firstName;
        $email = $this->argument('demo') == true ? 'demo@newgen.company' : $this->ask('Admin email', false);
    
        if (empty($email)) {
            $this->comment('Operation closed. Root email is empty.');
            return;
        }
    
        $checkExistsEmail = \App\Models\User::where('email', $email)->first();
    
        if (!empty($checkExistsEmail)) {
            $this->comment('Admin with this email already exists');
            return;
        }
    
        $login = $this->argument('demo') == true ? 'demo' : $this->ask('Admin login', false);
    
        if (empty($login)) {
            $login = $email;
        }
    
        $checkExistsLogin = \App\Models\User::where('login', $login)->first();
    
        if (!empty($checkExistsLogin)) {
            $this->comment('Admin with this login already exists');
            return;
        }
    
        $askPassword = $this->argument('demo') == true ? 'demo' : $this->ask('Admin password [keep empty to generate automatically]', false);
    
        if (empty($askPassword)) {
            $this->comment('Password will be generated automatically.');
        }
    
        if ($this->argument('demo') != true) {
            $askAllFine = $this->ask('Is this data correct? Email: ' . $email . ', login: ' . $login . ', password: ' . $askPassword . ' [yes|no]');
        
            if ('yes' != $askAllFine) {
                $this->info('Okay, trying again.');
                $this->call('make:admin');
                return;
            }
        }
    
        $password = empty($askPassword) ? str_random(12) : $askPassword;
    
        $user = \App\Models\User::create([
            'name'     => $name,
            'email'    => $email,
            'login'    => $login,
            'password' => bcrypt($password),
            'my_id'    => null,
        ]);
        $user->assignRole('admin');
        $user->save();
    
        $this->info('registered admin:');
        $this->comment('name: ' . $name);
        $this->comment('email: ' . $email);
        $this->comment('login: ' . $login);
        $this->comment('password: ' . $password);
    }
}
