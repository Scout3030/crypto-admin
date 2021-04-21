<?php

namespace App\Observers;

use App\Helpers\Services\SegmentService;
use App\Models\Role;
use Auth;

class RolesObserver
{
    /**
     * @var \App\Helpers\Services\SegmentService
     */
    protected SegmentService $segment;

    public function __construct(SegmentService $segment)
    {
        $this->segment = $segment;
    }

    /**
     * Handle the Role "created" event.
     *
     * @param  \App\Models\Role  $role
     * @return void
     */
    public function created(Role $role)
    {
        $this->segment
            ->init(Auth::user())
            ->event('Role created', ['role' => $role->toArray()]);
    }

    /**
     * Handle the Role "updated" event.
     *
     * @param  \App\Models\Role  $role
     * @return void
     */
    public function updated(Role $role)
    {
        $this->segment
            ->init(Auth::user())
            ->event('Role updated', ['role' => $role->toArray()]);
    }

    /**
     * Handle the Role "deleted" event.
     *
     * @param  \App\Models\Role  $role
     * @return void
     */
    public function deleted(Role $role)
    {
        $this->segment
            ->init(Auth::user())
            ->event('Role deleted', ['role' => $role->toArray()]);
    }

    /**
     * Handle the Role "restored" event.
     *
     * @param  \App\Models\Role  $role
     * @return void
     */
    public function restored(Role $role)
    {
        //
    }

    /**
     * Handle the Role "force deleted" event.
     *
     * @param  \App\Models\Role  $role
     * @return void
     */
    public function forceDeleted(Role $role)
    {
        //
    }
}
