<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <title>@yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="robots" content="noindex">
    <meta name="googlebot" content="noindex">

    <meta name="mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-touch-fullscreen" content="yes">
    <meta name="HandheldFriendly" content="True">
    <link rel="icon" href="{{ asset('public/m/favicon.ico')}}" type="image/x-icon">
    <!-- Bootstrap v4.3.1 CSS -->
    <link rel="stylesheet" href="{{ asset('public/m/lib/bootstrap/css/bootstrap.min.css')}}">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('public/m/css/normalize.css')}}">
    <link rel="stylesheet" href="{{ asset('public/m/css/theme.css')}}">
    <!-- Slick CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('public/m/lib/slick/slick/slick.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/m/lib/slick/slick/slick-theme.css')}}">
    <!-- Magnific Popup core CSS file -->
    <link rel="stylesheet" href="{{ asset('public/m/lib/Magnific-Popup-master/dist/magnific-popup.css')}}">
    <!-- Font Awesome Free 5.10.2 CSS JS -->
    <link href="{{ asset('public/m/lib/fontawesome-free-5.10.2-web/css/all.css')}}" rel="stylesheet">
    <script defer src="{{ asset('public/m/lib/fontawesome-free-5.10.2-web/js/brands.js')}}"></script>
    <script defer src="{{ asset('public/m/lib/fontawesome-free-5.10.2-web/js/solid.js')}}"></script>
    <script defer src="{{ asset('public/m/lib/fontawesome-free-5.10.2-web/js/fontawesome.js')}}"></script>
    <link href="{{asset('public/m/lib/gijgo/css/gijgo.min.css')}}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
</head>
<body class="default">

@include('m.layouts.header')
@yield('content')
@include('m.layouts.footer')

</body>
</html>
