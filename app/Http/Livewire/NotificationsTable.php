<?php

namespace App\Http\Livewire;

use App\Helpers\Enums\YesNo;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class NotificationsTable extends Component
{
    public function markAsRead(Notification $notification){
        $notification->read = (string) YesNo::YES;
        $notification->save();
        $this->emit('updateCounter');
    }

    public function deleteNotification(Notification $notification){
        $notification->delete();
        $this->emit('updateCounter');
    }

    public function render()
    {
        $user = Auth::user();
        $newNotifications = Notification::whereUserId($user->id)
            ->whereDay('created_at', now()
            ->format('d'))
            ->orderByDesc('created_at')
            ->get();
        $earlierNotifications = Notification::whereUserId($user->id)
            ->where('created_at', '<', now()
            ->format('Y-m-d'))
            ->orderByDesc('created_at')
            ->get();

            return view('livewire.notifications-table', [
            'newNotifications' => $newNotifications,
            'earlierNotifications' => $earlierNotifications
        ]);
    }
}
