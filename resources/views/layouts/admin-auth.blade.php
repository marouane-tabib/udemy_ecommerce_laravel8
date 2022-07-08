<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="robots" content="all,follow">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="author" content="MarwanTabib">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Custom fonts for this template-->
    <link href="{{ asset('back/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <!-- Favicon-->
    <link rel="shortcut icon" href="{{ asset('front/img/favicon.png') }}">
    <!-- Styles -->
    <link href="{{ asset('back/css/sb-admin-2.min.css') }}" rel="stylesheet">
    @yield('style')
    <title>SB Admin 2 - Dashboard</title>
</head>
<body class="bg-gradient-primary">

<div class="container">
    @yield('content')
</div>


<!-- Bootstrap core JavaScript-->
<script src="{{ asset('back/vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('back/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- Core plugin JavaScript-->
<script src="{{ asset('back/vendor/jquery-easing/jquery.easing.min.js') }}"></script>
<!-- Custom scripts for all pages-->
<script src="{{ asset('back/js/sb-admin-2.min.js') }}"></script>
@yield('script')
</body>
</html>
