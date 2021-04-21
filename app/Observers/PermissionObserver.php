<?php

namespace App\Observers;

use App\Helpers\Services\SegmentService;
use App\Models\Permission;
use Auth;

class PermissionObserver
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
     * Handle the Permission "created" event.
     *
     * @param  \App\Models\Permission  $permission
     * @return void
     */
    public function created(Permission $permission)
    {
        $this->segment
            ->init(Auth::user())
            ->event('Permission created', ['permission' => $permission->toArray()]);
    }

    /**
     * Handle the Permission "updated" event.
     *
     * @param  \App\Models\Permission  $permission
     * @return void
     */
    public function updated(Permission $permission)
    {
        $this->segment
            ->init(Auth::user())
            ->event('Permission updated', ['permission' => $permission->toArray()]);
    }

    /**
     * Handle the Permission "deleted" event.
     *
     * @param  \App\Models\Permission  $permission
     * @return void
     */
    public function deleted(Permission $permission)
    {
        $this->segment
            ->init(Auth::user())
            ->event('Permission deleted', ['permission' => $permission->toArray()]);
    }

    /**
     * Handle the Permission "restored" event.
     *
     * @param  \App\Models\Permission  $permission
     * @return void
     */
    public function restored(Permission $permission)
    {
        //
    }

    /**
     * Handle the Permission "force deleted" event.
     *
     * @param  \App\Models\Permission  $permission
     * @return void
     */
    public function forceDeleted(Permission $permission)
    {
        //
    }
}
