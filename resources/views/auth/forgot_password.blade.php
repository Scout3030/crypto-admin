@extends('layouts.guest')

@section('content')
  <div class="row justify-content-center h-100 align-items-center">
      <div class="col-lg-6 col-md-4">
          <img class="logoLogin" src="{{ asset('img/logo.png') }}" alt="">
      </div>
      <div class="col-lg-6 col-md-8">
          <div class="contLogin w-100">
              <h2>Reset Password</h2>
              <p>Enter your email address to get reset password link</p>

              <form action="{{ route('auth.sendPasswordResetEmail') }}" class="formLogin" method="POST">
                  @csrf

                  @if ( Session::has('status') )
                      <div class="alert alert-success" role="alert">
                          <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="mr-2">
                              <polyline points="9 11 12 14 22 4"></polyline>
                              <path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path>
                          </svg> <strong>Success!</strong> {{ Session::get('status') }}
                      </div>
                  @endif

                  <div class="mb-3">
                      <label class="form-label">Email</label>
                      <input name="email" class="form-control @error('email') validation @enderror" placeholder="Enter Your Email" type="text" value="{{ old('email') }}">
                      @error('email')
                          <div class="form-text validation pb-3">{{ $message }}</div>
                      @enderror
                  </div>
                  <button class="btn btn-primary" type="submit">Get Reset Link</button>
              </form>

          </div>
      </div>
  </div>
  @endsection
