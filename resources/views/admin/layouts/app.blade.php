<!DOCTYPE html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', '관리자') }}</title>
        <link href="{{ asset('argon') }}/img/brand/favicon.png" rel="icon" type="image/png">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
        <link href="{{ asset('argon') }}/vendor/nucleo/css/nucleo.css" rel="stylesheet">
        <link href="{{ asset('argon') }}/vendor/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">
        <link type="text/css" href="{{ asset('argon') }}/css/argon.css" rel="stylesheet">
        <link type="text/css" href="{{ asset('argon') }}/select2/select2.min.css" rel="stylesheet">
    </head>
    <body class="{{ $class ?? '' }}">
    <script>
        var a_token = '{{$user['api_token']}}';
        function formatNumber(number)
        {
            number = number.toFixed(2) + '';
            x = number.split('.');
            x1 = x[0];
            x2 = x.length > 1 ? '.' + x[1] : '';
            var rgx = /(\d+)(\d{3})/;
            while (rgx.test(x1)) {
                x1 = x1.replace(rgx, '$1' + ',' + '$2');
            }
            return x1;
        }
    </script>
            <form id="logout-form" action="" method="POST" style="display: none;">
                @csrf
            </form>
            @include('admin.layouts.navbars.sidebar')
        <div class="main-content">
            @include('admin.layouts.navbars.navbar')
            @yield('content')
        </div>

{{--        @guest()--}}
{{--            @include('admin.layouts.footers.guest')--}}
{{--        @endguest--}}

    <script src="{{ asset('argon') }}/vendor/jquery/dist/jquery.min.js"></script>
    <script src="{{ asset('argon') }}/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('argon') }}/js/common.js"></script>
    <script src="{{ asset('argon') }}/select2/select2.min.js"></script>

{{--    <script src="{{ asset('argon') }}/js/ckeditor.js"></script>--}}
        @stack('js')
        @yield('footer')
    </body>
</html>
