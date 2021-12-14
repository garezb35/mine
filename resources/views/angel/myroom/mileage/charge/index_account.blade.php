@extends('layouts-mania.app')

@section('head_attach')
    <link type="text/css" rel="stylesheet" href="/angel/myroom/mileage/my_mileage/css/index.css?700101" />
@endsection

@section('foot_attach')
    <script type='text/javascript' src='/angel/myroom/mileage/payment/js/mile_gift.js?210323'></script>
    <script type='text/javascript'>


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
        @include('angel.myroom.aside', ['group'=>'mileage', 'part'=>'my_mileage'])
        <div class="g_content">
            <iframe class="charge-iframe" src="{{route("mileage_payment_charge_iframe")}}" />
        </div>
        <div class="g_finish"></div>
    </div>
    <!-- ▲ 컨텐츠 영역 //-->
@endsection
