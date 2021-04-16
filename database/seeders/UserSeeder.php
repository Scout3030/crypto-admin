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
        $adminEmail = 'support@cryptomatix.io';
        $adminPassword = 'RByA3eHkAPmgLXQc';

        $user = User::whereEmail($adminEmail)->first();
        if (!$user) {
            User::updateOrCreate([
                'first_name' => 'Adrian',
                'last_name'  => 'William',
                'email'      => $adminEmail,
            ], [
                'password' => bcrypt($adminPassword),
                'role' => Roles::SU
            ]);
        }

        $user2Email = 'valenzuela.eduardo@gmail.com';
        $user2Password = '12345678';

        $user2 = User::whereEmail($user2Email)->first();
        if (!$user2) {
            User::updateOrCreate([
                'first_name' => 'Adrian',
                'last_name'  => 'William',
                'email'      => $user2Email,
            ], [
                'password' => bcrypt($user2Password),
                'role' => Roles::SU
            ]);
        }
    }
}
