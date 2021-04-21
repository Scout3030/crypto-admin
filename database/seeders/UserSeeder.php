<?php

namespace Database\Seeders;

use App\Helpers\Roles;
use App\Models\Role;
use App\Models\User;
use App\Models\UserRole;
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
        $rootEmail = 'support@cryptomatix.io';
        $rootPassword = 'RByA3eHkAPmgLXQc';
        $root = User::whereEmail($rootEmail)->first();

        if (!$root) {
            User::updateOrCreate(
                [
                    'first_name' => 'Adrian',
                    'last_name'  => 'William',
                    'email'      => $rootEmail
                ],
                [
                    'password' => bcrypt($rootPassword),
                    'role' => Roles::ROOT,
                    'role_id' => Role::whereName(Role::ROLE_NAME_ROOT)->first()->id,
                ]
            );
        }

        $managerEmail = 'admin@cryptomatix.io';
        $managerPassword = '12345678';
        $manager = User::whereEmail($managerEmail)->first();

        if (!$manager) {
            User::updateOrCreate(
                [
                    'first_name' => 'Admin',
                    'last_name'  => 'Cryptomatix',
                    'email'      => $managerEmail
                ],
                [
                    'password' => bcrypt($managerPassword),
                    'role' => Roles::ROOT,
                    'role_id' => Role::whereName(Role::ROLE_NAME_ROOT)->first()->id
                ]
            );
        }

        $managerEmail = 'rishabh@cryptomatix.io';
        $managerPassword = '12345678';
        $manager = User::whereEmail($managerEmail)->first();

        if (!$manager) {
            User::updateOrCreate(
                [
                    'first_name' => 'Rishabh',
                    'last_name'  => 'Kumar',
                    'email'      => $managerEmail
                ],
                [
                    'password' => bcrypt($managerPassword),
                    'role' => Roles::ROOT,
                    'role_id' => Role::whereName(Role::ROLE_NAME_ROOT)->first()->id
                ]
            );
        }

        $managerEmail = 'dhriti@cryptomatix.io';
        $managerPassword = '12345678';
        $manager = User::whereEmail($managerEmail)->first();

        if (!$manager) {
            User::updateOrCreate(
                [
                    'first_name' => 'Dhriti',
                    'last_name'  => 'Pipil',
                    'email'      => $managerEmail
                ],
                [
                    'password' => bcrypt($managerPassword),
                    'role' => Roles::ROOT,
                    'role_id' => Role::whereName(Role::ROLE_NAME_ROOT)->first()->id
                ]
            );
        }

        $managerEmail = 'ruchi@cryptomatix.io';
        $managerPassword = 'RByA3eHkAPmgLXQc';
        $manager = User::whereEmail($managerEmail)->first();

        if (!$manager) {
            User::updateOrCreate(
                [
                    'first_name' => 'Ruchi',
                    'last_name'  => 'Rathor',
                    'email'      => $managerEmail
                ],
                [
                    'password' => bcrypt($managerPassword),
                    'role' => Roles::ROOT,
                    'role_id' => Role::whereName(Role::ROLE_NAME_ROOT)->first()->id
                ]
            );
        }

        $managerEmail = 'valenzuela.eduardo@gmail.com';
        $managerPassword = '12345678';
        $manager = User::whereEmail($managerEmail)->first();

        if (!$manager) {
            User::updateOrCreate(
                [
                    'first_name' => 'Eduardo',
                    'last_name'  => 'Valenzuela',
                    'email'      => $managerEmail
                ],
                [
                    'password' => bcrypt($managerPassword),
                    'role' => Roles::ROOT,
                    'role_id' => Role::whereName(Role::ROLE_NAME_ROOT)->first()->id
                ]
            );
        }
    }
}
