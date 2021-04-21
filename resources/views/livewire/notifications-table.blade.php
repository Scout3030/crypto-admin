<div class="content card">
    <div class="card-body">
        Today
        <ul class="list-group">
            @forelse($newNotifications as $newNotification)
                <li class="list-group-item" wire:key="{{ $newNotification->id }}">A user {{ $newNotification->event }} <br> {{ $newNotification->created_at->format('M d') }}
                    @if($newNotification->read == \App\Helpers\Enums\YesNo::NO)
                        <button class="btn btn-sm" wire:click="markAsRead({{ $newNotification->id }})">Mark as read</button>
                    @endif
                </li>
            @empty
                No new notifications
            @endforelse
        </ul>
    </div>

    <div class="card-body">
        Earlier
        <ul class="list-group">
            @forelse($earlierNotifications as $notification)
                <li class="list-group-item" wire:key="{{ $notification->id }}">A user {{ $notification->event }} <br> {{ $notification->created_at->format('M d') }}
                    @if($notification->read == \App\Helpers\Enums\YesNo::NO)
                    <button class="btn btn-sm btn-success" wire:click="markAsRead({{ $notification->id }})">Mark as read</button>
                    @endif
                    <button class="btn btn-sm btn-danger" wire:click="deleteNotification({{ $notification->id }})">Delete</button>
                </li>
            @empty
                No notifications
            @endforelse
        </ul>
    </div>
</div>
