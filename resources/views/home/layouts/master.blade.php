<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>@yield('title')</title>

    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('/templates/css/open-iconic-bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/templates/css/animate.css') }}">

    <link rel="stylesheet" href="{{ asset('/templates/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/templates/css/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/templates/css/magnific-popup.css') }}">

    <link rel="stylesheet" href="{{ asset('/templates/css/aos.css') }}">

    <link rel="stylesheet" href="{{ asset('/templates/css/ionicons.min.css') }}">

    <link rel="stylesheet" href="{{ asset('/templates/css/bootstrap-datepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('/templates/css/jquery.timepicker.css') }}">


    <link rel="stylesheet" href="{{ asset('/templates/css/flaticon.css') }}">
    <link rel="stylesheet" href="{{ asset('/templates/css/icomoon.css') }}">
    <link rel="stylesheet" href="{{ asset('/templates/css/style.css') }}">
    @stack('styles')
</head>

<body class="goto-here">
        <!-- Navbar -->
        @yield('navbar')
        <!-- Navbar -->

        <!-- Content -->
        @yield('content')
        <!-- Content -->

        <!-- Footer -->
        @yield('footer')
        <!-- Footer -->

        <!-- loader -->
        <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00"/></svg></div>

        <!-- Scripts -->
        @stack('scripts')
        <script src="{{ asset('/templates/js/jquery.min.js') }}"></script>
        <script src="{{ asset('/templates/js/jquery-migrate-3.0.1.min.js') }}"></script>
        <script src="{{ asset('/templates/js/popper.min.js') }}"></script>
        <script src="{{ asset('/templates/js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('/templates/js/jquery.easing.1.3.js') }}"></script>
        <script src="{{ asset('/templates/js/jquery.waypoints.min.js') }}"></script>
        <script src="{{ asset('/templates/js/jquery.stellar.min.js') }}"></script>
        <script src="{{ asset('/templates/js/owl.carousel.min.js') }}"></script>
        <script src="{{ asset('/js/custom.js') }}"></script>
        <script src="{{ asset('/templates/js/jquery.magnific-popup.min.js') }}"></script>
        <script src="{{ asset('/templates/js/aos.js') }}"></script>
        <script src="{{ asset('/templates/js/jquery.animateNumber.min.js') }}"></script>
        <script src="{{ asset('/templates/js/bootstrap-datepicker.js') }}"></script>
        <script src="{{ asset('/templates/js/scrollax.min.js') }}"></script>
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>
        <script src="{{ asset('/templates/js/google-map.js') }}"></script>
        <script src="{{ asset('/templates/js/main.js') }}"></script>
</body>

</html>
