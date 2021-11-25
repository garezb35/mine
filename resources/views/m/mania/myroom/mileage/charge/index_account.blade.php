@extends('layouts-mania.app')

@section('head_attach')
    <link type="text/css" rel="stylesheet" href="/mania/myroom/mileage/my_mileage/css/index.css?700101" />
    <script type="text/javascript" src="/mania/advertise/advertise_code_head.js?v=200727"></script>
    <script type="text/javascript" src="/mania/_banner/js/banner_module.js?v=210209"></script>
@endsection

@section('foot_attach')
    <script type='text/javascript' src='/mania/myroom/mileage/payment/js/mile_gift.js?210323'></script>
    <script type='text/javascript'>
        var gsVersion = '2110141801';
        var _LOGINCHECK = '1';
    </script>
@endsection

@section('content')
    <style>
        .charge-iframe {
            width: 100%;
            height: 600px;
            border: none;
        }
    </style>
    <!--▼▼▼ 캐릭터 등롤 알리미 ▼▼▼ -->
    <div class="g_container" id="g_CONTENT">
        @include('mania.myroom.aside', ['group'=>'mileage', 'part'=>'my_mileage'])
        <div class="g_content">
            <iframe class="charge-iframe" src="{{route("mileage_payment_charge_iframe")}}" />
        </div>
        <div class="g_finish"></div>
    </div>
    <!-- ▲ 컨텐츠 영역 //-->
@endsection