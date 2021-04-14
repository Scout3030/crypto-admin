<?php

namespace Database\Seeders;

use App\Helpers\Roles;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::updateOrCreate([
            'first_name' => 'Adrian',
            'last_name'  => 'William',
            'email'      => 'support@cryptomatix.io',
        ], [
            'password' => bcrypt('RByA3eHkAPmgLXQc'),
            'roles' => Roles::SU,
        ]);
    }
}
