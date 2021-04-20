<?php

namespace App\Helpers\Gates;

use App\Helpers\Facades\Permissions;
use App\Models\Permission;
use App\Models\User;
use Gate;
use Schema;

class CommonGates
{
    public static function register(): void
    {
        if (Schema::hasTable('permissions')) {
            Permission::all()
                      ->each(fn($permission) => Gate::define(
                          $permission->name,
                          function (User $user) use ($permission) {
                              return Permissions::userHasPermission($user, $permission->name);
                          }));
        }
    }
}
