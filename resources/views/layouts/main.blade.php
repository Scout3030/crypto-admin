<!DOCTYPE html>
<html lang="en" class="h-100">
<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
	<link rel="shortcut icon" type="image/png" href="{{ asset('img/favicon.png') }}"/>

	<!-- Bootstrap CSS -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">

    <!-- FontAwesome -->
    <link rel="stylesheet" href="{{asset('css/font-awesome.min.css')}}">

	<!-- Styles -->
	<link rel="stylesheet" href="{{ asset('fonts/flaticon.css') }}">
	<link rel="stylesheet" href="{{ asset('css/main.css') }}">

    @stack('css')

	<title>Cryptomatix - Dashboard</title>
</head>
<body class="h-100 dashboard">

    @include('partials.sidebar')


	<div id="content">

		@include('partials.header')

		<main>
			<div class="container-fluid">

                @yield('content')

			</div>
		</main>
	</div>

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="{{asset('js/jquery-3.6.0.min.js')}}"></script>
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
