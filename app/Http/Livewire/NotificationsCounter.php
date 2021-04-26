<?php

namespace App\Http\Livewire;

use App\Helpers\Enums\YesNo;
use App\Models\Notification;
use Livewire\Component;

class NotificationsCounter extends Component
{
    protected int $counter = 0;
    protected bool $updated = false;
    protected $listeners = ['updateCounter' => 'updateCounter'];

    public function updateCounter() {
        $user = auth()->user();
        $this->counter = Notification::whereUserId($user->id)->whereRead((string) YesNo::NO)->get()->count();
    }

    public function render()
    {
        if(!$this->updated) {
            $user = auth()->user();
            $this->counter = Notification::whereUserId($user->id)->whereRead((string) YesNo::NO)->get()->count();
        }

        return view('livewire.notifications-counter', [
            'counter' => $this->counter
        ]);
    }
}
