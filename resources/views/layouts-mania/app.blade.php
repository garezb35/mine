<!DOCTYPE html>
<html lang="ko">
    <head>
        <title>taxify</title>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="keywords" content="">
        <meta name="description" content="">

        @yield('head_attach')
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link type="text/css" rel="stylesheet" href="/mania/dev/change.css">
        <link type="text/css" rel="stylesheet" href="/mania/dev/global.css">
        <link type="text/css" rel="stylesheet" href="/mania/photoswipe/css/photoswipe.css">
        <link type="text/css" rel="stylesheet" href="/mania/photoswipe/css/default-skin/default-skin.css">
    </head>

    <body>
    <script>
        var server_domain = '127.0.0.1';
        @if(Auth::check())
        var a_token = '{{Auth::user()->api_token}}';
        var _LOGINCHECK = '1';
         @else
        var a_token = '';
        var _LOGINCHECK = '0';
        @endif
    </script>
        <div id="g_SLEEP" class="g_sleep g_hidden">
            <div id="g_OVERLAY" class="g_overlay"></div>
        </div>
        <div class="g_body" id="g_BODY">
            @include('layouts-mania.header')
            @yield('content')
            @include('layouts-mania.footer')
        </div>
        <script type="text/javascript" src="/mania/_js/_jquery3.js"></script>
        <script type="text/javascript" src="/mania/_js/_comm.js"></script>
        <script type="text/javascript" src="/mania/_js/_gs_control_200924.js"></script>
        <script type="text/javascript" src="/mania/_js/_common_initialize_new.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/packery/1.4.3/packery.pkgd.min.js"></script>
        <script type="text/javascript" src="/mania/photoswipe/js/jquery.photoswipe-global.js"></script>
    @yield('foot_attach')

        <script type="text/javascript">
            _initialize();
        </script>
    </body>
</html>
