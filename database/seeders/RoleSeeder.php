<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::upsert([
            ['name' => Role::ROLE_NAME_ROOT, 'is_admin' => true],
            ['name' => Role::ROLE_NAME_MANAGER, 'is_admin' => true],
            ['name' => Role::ROLE_NAME_MERCHANT, 'is_admin' => false],
        ], ['name'], ['is_admin']);
    }
}
