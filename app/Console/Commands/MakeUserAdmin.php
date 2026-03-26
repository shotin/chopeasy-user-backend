<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Spatie\Permission\Models\Role;

class MakeUserAdmin extends Command
{
    protected $signature = 'user:make-admin {email : The user email address}';

    protected $description = 'Assign Admin role to a user by email (for admin dashboard access)';

    public function handle(): int
    {
        $email = $this->argument('email');

        $user = User::where('email', $email)->first();

        if (!$user) {
            $this->error("User with email '{$email}' not found.");
            return 1;
        }

        $role = Role::firstOrCreate(
            ['name' => 'Admin', 'guard_name' => 'api'],
            ['name' => 'Admin', 'guard_name' => 'api']
        );
        $user->assignRole($role);

        $this->info("Success! User '{$email}' is now an Admin. They can access the admin dashboard.");
        return 0;
    }
}
