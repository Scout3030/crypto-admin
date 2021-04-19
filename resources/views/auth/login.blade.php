@extends('layouts.guest')

@section('content')
    <div class="row justify-content-center h-100 align-items-center">
        <div class="col-lg-6 col-md-4">
            <img class="logoLogin" src="{{ asset('img/logo.png') }}" alt="">
        </div>
        <div class="col-lg-6 col-md-8">
            <div class="contLogin w-100">
                <h2>Sign In</h2>
                <p>Enter your email and password to access control panel.</p>
                @error('attempts')
                <div class="alert alert-info">{{ $message }}</div>
                @enderror

                <form class="formLogin" action="{{route('do.login')}}" method="POST" novalidate>
                    @csrf
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input id="email"
                               type="email"
                               name="email"
                               class="form-control @error('email') validation @enderror"
                               value="{{old('email')}}"
                               placeholder="Enter Your Email"
                               autocomplete="off"
                               required
                        >
                        @error('email')
                        <div class="form-text validation">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input id="password"
                               type="password"
                               name="password"
                               class="form-control @error('password') validation @enderror"
                               placeholder="Enter Your Password"
                               required
                        >
                        @error('password')
                        <div class="form-text validation">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3 form-check">
                        <input id="form-check-label" name="remember" type="checkbox" class="form-check-input">
                        <label for="form-check-label" class="form-check-label">Remember Me</label>
                    </div>
                    <button type="submit" class="btn btn-primary">Sign In</button>
                </form>
            </div>
        </div>
    </div>
@endsection
