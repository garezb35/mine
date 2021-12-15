@extends('layouts-angel.app')

@section('head_attach')
    <link type="text/css" rel="stylesheet" href="/angel/myroom/mileage/my_mileage/css/index.css?700101" />

    <script type="text/javascript" src="/angel/_banner/js/banner_module.js?v=210209"></script>
@endsection

@section('foot_attach')

    <script type='text/javascript' src='/angel/myroom/mileage/payment/js/mile_gift.js?210323'></script>
    <script type='text/javascript'>


    </script>
@endsection

@section('content')
    <style>
        .contextual--title {
            margin-left: 20px;
        }
        .react_nav_tab>* {
            background-color: #e3f0f3;
            border-bottom: 2px solid #0081b9;
        }
        .react_nav_tab>.selected {
            border: 2px solid #0081b9;
            border-bottom: 0;
        }
        .react_nav_tab>*>a {
            font-size: 14px;
        }
        .tb_list th {
            font-size: 14px;
        }
        .tb_list td {
            font-size: 13px;
        }
        .table-primary tr th {
            background-color: #e3f0f3;
        }
        .table-primary,
        .table-primary tr th,
        .table-primary tr td {
            border: solid 1px #89c1ce;
        }
    </style>

    <div class="container_fulids" id="module-teaser-fullscreen">
        @include('aside.myroom',['group'=>'mileage'])
        <div class="pagecontainer">

            <div class="contextual--title no-border">내 마일리지</div>


            <div class="react_nav_tab f-14">
                <div class="{{$type == 'charge' ? 'selected' : ''}}"><a href="{{route('my_mileage_index_c')}}">마일리지 충전</a></div>
                <div class="{{$type == 'exchange' ? 'selected' : ''}}"><a href="{{route('my_mileage_index_e')}}">마일리지 출금</a></div>
                <div class=""><a href="{{route('my_mileage_calendar')}}">마일리지 달력보기</a></div>
                <div class=""><a href="{{route('my_mileage_detail_list')}}">상세내역보기</a></div>
            </div>

            @if ($type == 'charge')
                <iframe src="{{route('mileage_payment_charge')}}" width="100%" height="500" frameBorder="0"></iframe>
            @else
                <iframe src="{{route('mileage_payment_exchange')}}" width="100%" height="500" frameBorder="0"></iframe>
            @endif
            <div class="empty-high"></div>
        </div>
        <div class="empty-high"></div>
    </div>

@endsection
