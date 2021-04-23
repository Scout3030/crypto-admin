@extends('layouts.main')

@section('content')
        <div class="titleMain">
            <h1>Permissions</h1>
            <p>Permissions / Edit Permissions</p>
        </div>
        <div class="content card">
            <div class="card-body">
                <h2 class="titleBody">@if($permission->name ?? '') Edit @else Create @endif Permission</h2>
                @if ($permission)
                    <livewire:permission-edit :permission="$permission"/>
                @else
                    <livewire:permission-edit/>
                @endif
            </div>
        </div>
@endsection
