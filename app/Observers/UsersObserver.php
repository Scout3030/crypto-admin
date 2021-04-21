<?php

namespace App\Observers;

use App\Helpers\Services\SegmentService;
use App\Models\User;
use Auth;

class UsersObserver
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
     * Handle the User "created" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function created(User $user)
    {
        $this->segment
            ->init(Auth::user())
            ->event('User created', ['user' => $user->toArray()]);
    }

    /**
     * Handle the User "updated" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function updated(User $user)
    {
        $this->segment
            ->init(Auth::user())
            ->event('User updated', ['user' => $user->toArray()]);
    }

    /**
     * Handle the User "deleted" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function deleted(User $user)
    {
        $this->segment
            ->init(Auth::user())
            ->event('User deleted', ['user' => $user->toArray()]);
    }

    /**
     * Handle the User "restored" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function restored(User $user)
    {
        //
    }

    /**
     * Handle the User "force deleted" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function forceDeleted(User $user)
    {
        //
    }
}
