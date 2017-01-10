<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use ShopKit\ACL\Models\ShopKitUser;

class MakeAdminAccount extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:admin';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create LulaBooks Admin Account';

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
        $username = $this->ask('Enter administrator username: ');
        $password = $this->secret('Enter administrator password: ');

        $admin = new ShopKitUser();
        $admin->email = $username;
        $admin->password = bcrypt($password);
        $admin->firstname = 'Admin';
        $admin->lastname = 'User';
        $admin->role = 'superadmin';
        $admin->save();

        $this->info('Created administrator account');
    }
}
