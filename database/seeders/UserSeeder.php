<?php

namespace Database\Seeders;

use App\Helpers\Roles;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::whereEmail('support@cryptomatix.io')->first();
        if (!$user) {
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
}
