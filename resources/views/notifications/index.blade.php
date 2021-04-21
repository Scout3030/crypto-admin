@extends('layouts.main')

@section('content')

    <div class="content card">

        <div class="card-body">
            Today
            <ul class="list-group">
                @forelse($newNotifications as $notification)
                <li class="list-group-item">An item</li>
                @empty
                    No new notifications
                @endforelse
            </ul>
        </div>

        <div class="card-body">
            Earlier
            <ul class="list-group">
                @forelse($earlierNotifications as $notification)
                    <li class="list-group-item">A user {{ $notification->event }}</li>
                @empty
                    No notifications
                @endforelse
            </ul>
        </div>
    </div>

@endsection
