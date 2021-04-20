<!DOCTYPE html>
<html lang="en" class="h-100">
<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
	<link rel="shortcut icon" type="image/png" href="{{ asset('img/favicon.png') }}"/>

	<!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{mix('css/app.css')}}">
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
    <script src="{{ mix('js/app.js') }}"></script>

    <script>
        jQuery.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
    @stack('scripts')
</body>
</html>
