<!DOCTYPE HTML>
<html>
    <head>
        <title>아이템천사</title>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
        <meta name="format-detection" content="telephone=no" />
        <meta name="keyword" content="">
        <meta name="description" content="">
        <link rel="stylesheet" href="/angel_mobile/main/css/common.css" />
        <link rel="stylesheet" href="/angel_mobile/_banner/css/banner_module.css" />
        <!-- 헤더 파트 -->
        @yield('head_attach')
        <!-- 헤더 파트 -->
        <script>
            @if (Auth::user())
                var a_token = '{{Auth::user()->api_token}}';
            @endif
        </script>
    </head>
    <body>
        <script>
            var server_domain = '210.112.174.178';
            var a_token = '';
            @if(Auth::check())
            a_token = '{{Auth::user()->api_token}}';
            @endif
            function basicPopup(url) {
                popupWindow = window.open(url,'popUpWindow','height=500,width=500,left=100,top=100,resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no, status=yes');
            }
        </script>
        <div class="roots" id="angel">
{{--            @include('layouts-angel.header')--}}
            @yield('content')
{{--            @include('layouts-angel.footer')--}}
        </div>
        <script src="/angel_mobile/main/js/jquery.min.js"></script>
        <script src="/angel/_js/webpack.js"></script>
        <script src="/angel_mobile/main/js/gs_control.js"></script>
        <script src="/angel_mobile/main/js/common.js"></script>
        <script src="/angel_mobile/main/js/swiper.min.js"></script>
        <script src="/angel_mobile/main/js/makePCookie.js"></script>
        <script src="/angel_mobile/_banner/js/banner_module.js"></script>
        <!-- 푸터 파트 -->
        @yield('foot_attach')
        <!-- 푸터 파트 -->
        <script type="text/javascript">
            loadGlobalItems()
        </script>
    </body>
</html>
