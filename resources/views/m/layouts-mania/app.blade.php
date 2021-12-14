<!DOCTYPE html>
<html lang="ko">
    <head>
        <title>아이템천사</title>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="keywords" content="">
        <meta name="description" content="">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link type="text/css" rel="stylesheet" href="/angel/photoswipe/css/photoswipe.css">
        <link type="text/css" rel="stylesheet" href="/angel/photoswipe/css/default-skin/default-skin.css">
        <link type="text/css" rel="stylesheet" href="/angel/_css/_comm.css">
        <link type="text/css" rel="stylesheet" href="/angel/_head_tail/css/_head_comm.css">
        <link type="text/css" rel="stylesheet" href="/angel/_banner/css/banner_module.css">
        <link type="text/css" rel="stylesheet" href="/angel/dev/global.css">
        <link type="text/css" rel="stylesheet" href="/angel/dev/change.css">
        @yield('head_attach')

    </head>

    <body>
    <script>
        var server_domain = '210.112.174.178';
        @if(Auth::check())
        var a_token = '{{Auth::user()->api_token}}';

         @else
        var a_token = '';

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
        <script type="text/javascript" src="/angel/_js/jquery.js"></script>
        <script type="text/javascript" src="/angel/_js/_comm.js"></script>
        <script type="text/javascript" src="/angel/_js/angelic-global.js"></script>
        <script type="text/javascript" src="/angel/_js/_common_initialize_new.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/packery/1.4.3/packery.pkgd.min.js"></script>
        <script type="text/javascript" src="/angel/photoswipe/js/jquery.photoswipe-global.js"></script>
    @yield('foot_attach')

        <script type="text/javascript">
            _initialize();
        </script>
    </body>
</html>
