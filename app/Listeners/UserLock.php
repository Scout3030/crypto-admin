<?php

namespace App\Listeners;

use App\Helpers\Services\SegmentService;
use Illuminate\Auth\Events\Lockout;
use Illuminate\Support\Facades\RateLimiter;

class UserLock
{
    /**
     * @var \App\Helpers\Services\SegmentService
     */
    protected SegmentService $segment;

    /**
     * Create the event listener.
     *
     * @param \App\Helpers\Services\SegmentService $segment
     */
    public function __construct(SegmentService $segment)
    {
        $this->segment = $segment;
    }

    /**
     * Handle the event.
     *
     * @param Lockout $event
     *
     * @return void
     * @throws \Exception
     */
    public function handle(Lockout $event)
    {
        $email = $event->request->email;

        $this->segment
            ->init()
            ->identify()
            ->event('Max attempts', [
                'email' => $email
            ]);
    }
}
