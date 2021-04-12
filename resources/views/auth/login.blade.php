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

                <form class="formLogin" action="">
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" class="form-control" placeholder="Enter Your Email">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input type="password" class="form-control" placeholder="Enter Your Password">
                    </div>
                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input">
                        <label class="form-check-label">Remember Me</label>
                    </div>
                    <button type="submit" class="btn btn-primary">Sign In</button>
                </form>
            </div>
        </div>
    </div>
@endsection
