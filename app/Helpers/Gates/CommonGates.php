<?php

namespace App\Helpers\Gates;

use App\Helpers\Facades\Permissions;
use App\Models\Permission;
use App\Models\User;
use Gate;

class CommonGates
{
    public static function register(): void
    {
        Permission::all()
                  ->each(fn($permission) => Gate::define($permission->name, function (User $user) use ($permission) {
                      return Permissions::userHasPermission($user, $permission->name);
                  }));
    }
}
