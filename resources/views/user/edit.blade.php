@extends('layouts.main')

@section('content')
    <div class="row justify-content-center h-100 align-items-center">
        <div class="col-12">
            <div class="contLogin w-100">
                <h2>@if($user) Edit @else Create @endif User</h2>
                <form class="formLogin" action="{{route('user.store')}}" method="POST">
                    @csrf
                    @if($user)
                        <input type="hidden" value="{{$user->id }}" name="id">
                    @endif
                    <div class="mb-3">
                        <label for="first-name">First Name</label>
                        <input type="text"
                               class="form-control @error('first_name') validation @enderror"
                               id="first-name"
                               name="first_name"
                               value="{{old('first_name', $user->first_name ?? '')}}"
                               autocomplete="off"
                        >
                    </div>
                    @error('first_name')
                    <div class="form-text validation pb-1">{{ $message }}</div>
                    @enderror
                    <div class="mb-3">
                        <label for="last-name">Last Name</label>
                        <input type="text"
                               class="form-control @error('last_name') validation @enderror"
                               id="last-name"
                               name="last_name"
                               value="{{old('last_name', $user->last_name ?? '')}}"
                               autocomplete="off"
                        >
                    </div>
                    @error('last_name')
                    <div class="form-text validation pb-1">{{ $message }}</div>
                    @enderror
                    <div class="mb-3">
                        <label for="email">Email</label>
                        <input type="email"
                               class="form-control @error('email') validation @enderror"
                               id="email"
                               name="email"
                               value="{{old('email', $user->email ?? '')}}"
                               autocomplete="off"
                        >
                    </div>
                    @error('email')
                    <div class="form-text validation pb-1">{{ $message }}</div>
                    @enderror
                    <div class="mb-3">
                        <label for="password">Password</label>
                        <input id="password"
                               type="password"
                               class="form-control @error('password') validation @enderror"
                               name="password"
                        >
                    </div>
                    @error('password')
                    <div class="form-text validation pb-1">{{ $message }}</div>
                    @enderror
                    <button type="submit" class="btn btn-primary">Store</button>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function () {

        })
    </script>
@endpush
