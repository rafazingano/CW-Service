<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
        <meta name="description" content="">
        <meta name="author" content="">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta http-equiv="cache-control" content="no-cache">
        <link rel="icon" href="favicon.ico">
        <title>Koote!</title>
        <link href="{{ asset('assets/css/bootstrap-tagsinput.css') }}" rel="stylesheet">
        <link href="{{ asset('assets/css/jquery-ui.css') }}" rel="stylesheet">
        <link href="{{ asset('assets/css/app.css') }}" rel="stylesheet">
        <link href="{{ asset('assets/css/login.css') }}" rel="stylesheet">
        <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
        @stack('styles')
    </head>
    <body>
        @include('partials.header')
        @yield('content')        
        @include('partials.footer')
        <script language="javascript" src="{{ asset('assets/js/jquery.min.js') }}"></script>
        <script language="javascript" src="{{ asset('assets/js/mask.js') }}"></script>
        <script language="javascript" src="{{ asset('assets/js/app.js') }}"></script>
        <script language="javascript" src="{{ asset('assets/js/bootstrap-tagsinput.min.js') }}"></script>
        <script language="javascript" src="{{ asset('assets/js/jquery-ui.js') }}"></script>
        <script language="javascript" src="{{ asset('assets/js/script.js') }}"></script>
        <script>
            window.Laravel = {!! json_encode([
                    'csrfToken' => csrf_token(),
            ]) !!}
            ;
        </script>
        @stack('scripts')
    </body>
</html>