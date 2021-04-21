<?php

namespace App\Providers;

use App\Models\Permission;
use App\Models\Role;
use App\Observers\PermissionObserver;
use App\Observers\RolesObserver;
use Illuminate\Support\ServiceProvider;

class ObserversProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Role::observe(RolesObserver::class);
        Permission::observe(PermissionObserver::class);
    }
}
