<?php

namespace App\Helpers\Services;

use App\Models\Role;
use App\Models\User;
use League\CommonMark\Block\Element\ThematicBreak;

class PermissionsHelper
{
    public function roleHasPermission(Role $role, string $permission): bool
    {
        if ($role->permissions->firstWhere('name', $permission)) {
            return true;
        }

        return false;
    }

    public function userHasPermission(User $user, string $permission): bool
    {
        $role = $user->roles;

        return $this->roleHasPermission($role, $permission);
    }

    public function isRoot(User $user): bool
    {
        if ($user->roles->firstWhere('name', Role::ROLE_NAME_ROOT)) {
            return true;
        }

        return false;
    }
}
