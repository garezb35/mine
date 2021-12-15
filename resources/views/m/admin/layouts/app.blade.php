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

        <link type="text/css" href="{{ asset('argon') }}/css/argon.css?v=1.0.0" rel="stylesheet">
    </head>
    <body class="{{ $class ?? '' }}">
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

        @stack('js')


        <script src="{{ asset('argon') }}/js/argon.js?v=1.0.0"></script>
    </body>
</html>
