<?php

namespace App\Http\Livewire;

use App\Helpers\Enums\YesNo;
use App\Models\Notification;
use Livewire\Component;

class NotificationsTable extends Component
{
    public function markAsRead(Notification $notification){
        $notification->read = (string) YesNo::YES;
        $notification->save();

        $this->emit('updateCounter');
    }

    public function render()
    {
        $newNotifications = Notification::whereRead((string) YesNo::NO)->get();
        $earlierNotifications = Notification::get();
//        $earlierNotifications = Notification::paginate(4);
        return view('livewire.notifications-table', [
            'newNotifications' => $newNotifications,
            'earlierNotifications' => $earlierNotifications
        ]);
    }
}
