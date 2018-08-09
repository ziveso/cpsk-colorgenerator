<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title></title>

    <link rel="stylesheet" href="{{ asset('themes/adminlte/vendor/bootstrap/dist/css/bootstrap.min.css') }}"/>
    <script src="{{ asset('themes/adminlte/vendor/jquery/jquery.min.js') }}"></script>
    @stack('css-stack')
</head>
<body>
    @yield('content')

    @if(config('app.env') == 'local')
        <script src="http://localhost:35729/livereload.js"></script>
    @endif
    <!-- Bootstrap -->
    <script src="{{ asset('themes/adminlte/vendor/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('themes/adminlte/vendor/iCheck/icheck.min.js') }}"></script>
    <script src="{{ asset('themes/adminlte/js/vendor/alertify/alertify.js') }}"></script>
    @stack('js-stack')
</body>
</html>
