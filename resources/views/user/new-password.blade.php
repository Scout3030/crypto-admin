@extends('layouts.main')

@section('content')
    <div class="titleMain">
        <h1>User</h1>
        <p>Change password</p>
    </div>

    <div class="content card">
        <div class="card-body">
            <livewire:new-password-form/>
        </div>
    </div>
@endsection
