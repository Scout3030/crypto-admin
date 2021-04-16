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
        $root = new Role();
        $root->name = Role::ROLE_NAME_ROOT;
        $root->is_admin = true;

        $root->save();

        $manager = new Role();
        $manager->name = Role::ROLE_NAME_MANAGER;
        $manager->is_admin = true;

        $manager->save();

        $manager = new Role();
        $manager->name = Role::ROLE_NAME_MERCHANT;
        $manager->is_admin = false;

        $manager->save();
    }
}
