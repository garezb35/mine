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
        <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>
    </head>
    <body class="{{ $class ?? '' }}">
    <script>
        var notice_count = {{$notice_count}};
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

    <script src="{{ asset('argon') }}/vendor/jquery/dist/jquery.min.js"></script>
    <script src="{{ asset('argon') }}/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('argon') }}/js/common.js"></script>
    <script src="{{ asset('argon') }}/select2/select2.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
    <script type="text/javascript" src="/angel/socket/socket.io.js"></script>
    <script>
        var server_domain = '210.112.174.178';
        var return_url = "";
        var return_msg = "";
        var socket_client = io.connect('http://'+server_domain+':7443/adminWith', {
            path: '/socket.io',
            reconnectionAttempts:1,
            reconnectionDelay:500,
            reconnectionDelayMax:500,
            transports: ['websocket']
        });

        socket_client.on('admin_notice',(data)=>{
            if(data.type == 1){
                return_msg = data.userName +"님이 마일리지 충전을 요청하셨습니다.";
                return_url = '/admin/mileage_charge?usr_alias=' + data.userName + '&state=0&type=0';
            }
            if(data.type == 2){
                return_msg = data.userName +"님이 마일리지 출금을 요청하셨습니다.";
                return_url = '/admin/mileage_charge?usr_alias=' + data.userName + '&state=0&type=1';
            }
            if(data.type == 3){
                return_msg = data.userName +"님이 주문번호 #"+ data.orderNo +" 물품을 구매취소요청하었습니다.";
                return_url = '/admin/order_list_request?usr_alias='+data.userName+'&orderNo='+data.orderNo;
            }
            if(data.type == 4){
                return_msg = data.userName +"님이 주문번호 #"+ data.orderNo +" 물품을 구매종료요청하었습니다.";
                return_url = '/admin/order_list_request?usr_alias='+data.userName+'&orderNo='+data.orderNo;
            }
            if(data.type == 5){
                return_msg = data.userName +"님이 주문번호 #"+ data.orderNo +" 물품을 판매취소요청하었습니다.";
                return_url = '/admin/order_list_request?usr_alias='+data.userName+'&orderNo='+data.orderNo;
            }
            if(data.type == 6){
                return_msg = data.userName +"님이 주문번호 #"+ data.orderNo +" 물품을 판매종료요청하었습니다.";
                return_url = '/admin/order_list_request?usr_alias='+data.userName+'&orderNo='+data.orderNo;
            }
            if(data.type == 7){
                return_msg = data.userName +"님이 신규게임서버추가를 요청하었습니다.";
                return_url = '/admin/new_gaming?usr_alias='+data.userName+'&response=1';
            }
            if(data.type == 8){
                return_msg = data.userName +"님이 이용관련문의를 하었습니다.";
                return_url = '/admin/use_relative?usr_alias='+data.userName+'&reply=1';
            }
            alertify.set('notifier','delay', 10);
            var alts = alertify.success(return_msg);
            alts.callback = function (isClicked) {
                if(isClicked)
                    location.href = return_url;
            };
            notice_count++;
            $("#mail-count").text(notice_count)
        })

    </script>
{{--    <script src="{{ asset('argon') }}/js/ckeditor.js"></script>--}}
        @stack('js')
        @yield('footer')
    </body>
<style>
    .notifyjs-foo-base {
        opacity: 0.85;
        width: 200px;
        background: #F5F5F5;
        padding: 5px;
        border-radius: 10px;
    }

    .notifyjs-foo-base .title {
        width: 100px;
        float: left;
        margin: 10px 0 0 10px;
        text-align: right;
    }

    .notifyjs-foo-base .buttons {
        width: 70px;
        float: right;
        font-size: 9px;
        padding: 5px;
        margin: 2px;
    }

    .notifyjs-foo-base button {
        font-size: 9px;
        padding: 5px;
        margin: 2px;
        width: 60px;
    }
</style>
</html>
