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
                @if ($errors->any())
                    <div class="alert alert-danger" role="alert">
                        <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="mr-2"><polyline points="9 11 12 14 22 4"></polyline><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path></svg>
                        @foreach ($errors->all() as $error)
                            <span>{{ $error }}</span>
                        @endforeach
                    </div>
                @endif

                <form class="formLogin" action="{{route('do.login')}}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email"
                               name="email"
                               class="form-control"
                               value="{{old('email')}}"
                               placeholder="Enter Your Email"
                               required
                        >
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input type="password"
                               name="password"
                               class="form-control"
                               placeholder="Enter Your Password"
                               required
                        >
                    </div>
                    <div class="mb-3 form-check">
                        <input name="remember" type="checkbox" class="form-check-input">
                        <label class="form-check-label">Remember Me</label>
                    </div>
                    <button type="submit" class="btn btn-primary">Sign In</button>
                </form>
            </div>
        </div>
    </div>
@endsection
