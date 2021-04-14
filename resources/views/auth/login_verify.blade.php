@extends('layouts.guest')

@section('content')
<div class="row justify-content-center h-100 align-items-center">
    <div class="col-lg-6 col-md-4">
        <img class="logoLogin" src="{{ asset('img/logo.png') }}" alt="">
    </div>
        <div class="col-lg-6 col-md-8">
            <div class="contLogin w-100">
            <h2>One Time Password</h2>
            <p>Enter the OTP, you have recieved at your registered email address</p>

            <form class="formLogin" action="{{ route('auth.login.verify') }}" method="POST">
                @csrf

                @if ( Session::has('success') )
                    <div class="alert alert-success" role="alert">
                        <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="mr-2">
                            <polyline points="9 11 12 14 22 4"></polyline>
                            <path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path>
                        </svg> <strong>Sucess!</strong> Your account is registered. You will shortly receive and email to activate your account.
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger" role="alert">
                        <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="mr-2"><polyline points="9 11 12 14 22 4"></polyline><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path></svg>
                        @foreach ($errors->all() as $error)
                            <span>{{ $error }}</span>
                        @endforeach
                    </div>
                @endif
                
                @if ( Session::has('message') )
                    @include('partials.notification')
                @endif

                <div class="mb-3">
                    <label class="form-label">One Time Password</label>
                    <input type="text" name="otp_token" class="form-control" placeholder="Enter the OTP" required>
                </div>
                <button type="submit" class="btn btn-primary">Verify</button>
                <div class="form-text">Did not recieve the OTP code? 
                    <a class="send-otp-button" href="#"
                        onclick="event.preventDefault();
                        console.log('here')
                        document.getElementById('send').submit();"
                    >
                        Send it again
                    </a>
                </div>
            </form>
            <form id="send" action="{{ route('auth.send.otp.code') }}" method="POST" style="display: none;">
                @csrf
                <input type="hidden" value="{{ Session::get('otp-email') }}">
            </form>
        </div>
    </div>
</div>
@endsection
