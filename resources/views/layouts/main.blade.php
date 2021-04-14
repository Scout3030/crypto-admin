<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-100">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" type="image/png" href="{{ asset('img/favicon.png') }}"/>

    <!-- Bootstrap CSS -->
    <link href="{{asset('vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
    @stack('css')
    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">

    <title>Cryptomatix</title>
</head>
<body class="h-100">
<div class="container h-100">
    @yield('content')
</div>

<script src="{{asset('js/jquery-3.6.0.min.js')}}"></script>
<script src="{{asset('vendor/bootstrap/js/bootstrap.bundle.js')}}"></script>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
@stack('scripts')
</body>
</html>

