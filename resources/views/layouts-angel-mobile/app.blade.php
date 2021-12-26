<!DOCTYPE HTML>
<html>
    <head>
        <title>아이템천사</title>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
        <meta name="format-detection" content="telephone=no" />
        <meta name="keyword" content="">
        <meta name="description" content="">
        <link rel="stylesheet" href="/angel_mobile/main/css/init.css" />
        @yield('head_attach')
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
            @yield('content')
        </div>
        <script src="/angel_mobile/main/js/jquery.min.js"></script>
        <script src="/angel_mobile/main/js/ut__webpack.js"></script>
        <script src="/angel_mobile/main/js/hjts_ss.js"></script>
        <script src="/angel_mobile/main/js/swiper.min.js"></script>
        <script src="/angel_mobile/main/js/makePCookie.js"></script>

        @yield('foot_attach')

    </body>
</html>
