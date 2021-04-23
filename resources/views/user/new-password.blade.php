@extends('layouts.main')

@section('content')
    <div class="titleMain">
        <h1>Change Password</h1>
    </div>

    <div class="content card">
        <div class="card-body">
            <livewire:new-password-form/>
        </div>
    </div>
@endsection
