<div class="titleMain">
    <h1>Notificactions</h1>
</div>
<div class="content card">
    <div class="card-body">
        <div class="notificationCard">
            <h2>Today</h2>
            <ul class="notificationList">
                @forelse($newNotifications as $newNotification)
                    <li class="" wire:key="{{ $newNotification->id }}">
                        <div class="notiText">{{ $newNotification->event }} <br> <span style="color: #8a8989">{{ $newNotification->created_at->format('M d') }}</span></div>
                        <div class="notiAction">
                            @if($newNotification->read == \App\Helpers\Enums\YesNo::NO)
                                <button class="btn" wire:click="markAsRead({{ $newNotification->id }})"><i class="fa fa-check-square" aria-hidden="true"></i></button>
                            @endif
                        </div>
                    </li>
                @empty
                    <li class="noNoti">No new notifications</li>
                @endforelse
            </ul>
        </div>

        <div class="notificationCard">
            <h2>Earlier</h2>
            <ul class="notificationList">
                @forelse($earlierNotifications as $notification)
                    <li class="" wire:key="{{ $notification->id }}">
                        <div class="notiText">{{ $notification->event }} <br> <span style="color: #8a8989">{{ $notification->created_at->format('M d') }}</span></div>
                        <div class="notiAction">
                            @if($notification->read == \App\Helpers\Enums\YesNo::NO)
                                <button class="btn" wire:click="markAsRead({{ $notification->id }})"><i class="fa fa-check-square" aria-hidden="true"></i></button>
                            @endif
                            <button class="btn" wire:click="deleteNotification({{ $notification->id }})"><i class="fa fa-times" aria-hidden="true"></i></button>
                        </div>
                    </li>
                @empty
                    <li class="noNoti">No notifications</li>
                @endforelse
            </ul>
        </div>
    </div>
</div>