@extends('layouts.guest')

@section('content')
    <div class="row justify-content-center h-100 align-items-center">
        <div class="col-lg-6 col-md-4">
            <img class="logoLogin" src="{{ asset('img/logo.png') }}" alt="">
        </div>
        <div class="col-lg-6 col-md-8">
            <div class="contLogin w-100">
            <h2>Reset Password</h2>
            <p>Enter your new desired password.</p>

                <form class="formLogin" action="{{ route('user.update.password') }}" method="POST" novalidate>
                    @method('put')
                    @csrf

                    @if ( Session::has('message') )
                        <div class="alert alert-success" role="alert">
                            <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="mr-2">
                                <polyline points="9 11 12 14 22 4"></polyline>
                                <path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path>
                            </svg> <strong>Sucess!</strong> You will receive and email with the OTP.'
                        </div>
                    @endif

                    <div class="mb-3">
                        <label for="password" class="form-label">New Password</label>
                        <input id="password"
                               type="password"
                               name="password"
                               class="form-control @error('password') validation @enderror"
                               placeholder="Enter Your Password"
                               autocomplete="off"
                               required
                        >
                        @error('password')
                        <div class="form-text validation">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label">Confirm Password</label>
                        <input id="password_confirmation"
                               type="password"
                               name="password_confirmation"
                               class="form-control @error('password_confirmation') validation @enderror"
                               placeholder="Enter Your Password"
                               autocomplete="off"
                               required
                        >
                        @error('password_confirmation')
                        <div class="form-text validation">{{ $message }}</div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Reset Password</button>
                </form>
            </div>
        </div>
    </div>
@endsection
