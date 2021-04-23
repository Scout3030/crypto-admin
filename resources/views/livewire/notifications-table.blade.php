<div class="titleMain">
    <h1>Notificactions</h1>
</div>
<div class="content card">
    <div class="card-body">
        <div class="notificationCard">
            <h2>Today</h2>
            <ul class="notificationList">
                @forelse($newNotifications as $newNotification)
                    <li class="" wire:key="{{ $newNotification->id }}">A user {{ $newNotification->event }} <br> {{ $newNotification->created_at->format('M d') }}
                        @if($newNotification->read == \App\Helpers\Enums\YesNo::NO)
                            <button class="btn btn-sm" wire:click="markAsRead({{ $newNotification->id }})">Mark as read</button>
                        @endif
                    </li>
                @empty
                    No new notifications
                @endforelse
            </ul>
        </div>

        <div class="notificationCard">
            <h2>Earlier</h2>
            <ul class="notificationList">
                @forelse($earlierNotifications as $notification)
                    <li class="" wire:key="{{ $notification->id }}">A user {{ $notification->event }} <br> {{ $notification->created_at->format('M d') }}
                        @if($notification->read == \App\Helpers\Enums\YesNo::NO)
                        <button class="btn shadow btn-xs sharp btn-success" wire:click="markAsRead({{ $notification->id }})">Mark as read</button>
                        @endif
                        <button class="btn shadow btn-xs sharp btn-danger" wire:click="deleteNotification({{ $notification->id }})"><i class="fa fa-trash"></i></button>
                    </li>
                @empty
                    No notifications
                @endforelse
            </ul>
        </div>
    </div>
</div>
