@extends('layouts-angel.app')

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

    <div class="container_fulids" id="module-teaser-fullscreen">
        @include('angel.myroom.aside', ['group'=>'mileage', 'part'=>'my_mileage'])
        <div class="pagecontainer">
            <iframe class="charge-iframe" src="{{route("mileage_payment_charge_iframe")}}" />
        </div>
        <div class="empty-high"></div>
    </div>

@endsection
