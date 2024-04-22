<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class GenerateAdminUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generate:admin-user';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate an Admin User who can log in and export user data';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        \App\Models\User::create([
            'name'       => 'Admin',
            'email'      => 'admin@admin.com',
            'password'   => 'password',
            'last_name'  => '',
            'dni'        => '',
            'department' => '',
            'city'       => '',
            'phone'      => '',
        ]);
    }
}
