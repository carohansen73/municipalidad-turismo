<!DOCTYPE html>
<html lang="{!! env('APP_LOCALE') !!}">
<head>
    <meta charset="UTF-8">
    <meta name="author" content="Diego Gonzalez - Carolina Hansen">
    <meta name="copyright" content="Claromecó Turismo">
    @yield('metadata')
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title') | {{ config('app.name') }}</title>
    {{-- Favicon --}}
    <link rel="shortcut icon" href="{{ asset('img/favicon.png') }}" type="image/x-icon">
    {{-- Google font --}}
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,400,300,500,600,700" rel="stylesheet">
    <link rel="stylesheet" href="{!! asset('css/font-awesome.min.css') !!}">
    <link rel="stylesheet" href="{!! asset('css/bootstrap.min.css') !!}">
    <link rel="stylesheet" href="{!! asset('css/owl.carousel.min.css') !!}">
    @yield('css')
    <link rel="stylesheet" href="{!! asset('css/main.min.css') !!}">
    <link rel="stylesheet" href="{!! asset('css/style.css') !!}">
</head>
<body>
    {{-- Start Header Area --}}
	<header class="default-header">
        @include('front.partials.nav')
    </header>
    {{-- End Header Area --}}

    @yield('content')

    @include('front.partials.footer')

    <script src="{!! asset('js/vendor/jquery-2.2.4.min.js') !!}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
    <script src="{!! asset('js/vendor/bootstrap.min.js') !!}"></script>
    <script src="{!! asset('js/jquery.ajaxchimp.min.js') !!}"></script>
    <script src="{!! asset('js/parallax.min.js') !!}"></script>
    <script src="{!! asset('js/owl.carousel.min.js') !!}"></script>
    <script src="{!! asset('js/jquery.sticky.min.js') !!}"></script>

    @yield('scripts')
    <script src="{!! asset('js/main.min.js') !!}"></script>
</body>
</html>
