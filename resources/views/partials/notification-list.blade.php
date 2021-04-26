<li><a href="{{ route('notifications.index') }}">View all</a></li>
<li><hr></li>
@foreach ($notifications as $notification)
<li>{{ $notification->event }}</li>
@endforeach
