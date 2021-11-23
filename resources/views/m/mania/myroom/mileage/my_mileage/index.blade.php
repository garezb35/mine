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
        .g_title_blue {
            margin-left: 20px;
        }
        .g_tab>* {
            background-color: #e3f0f3;
            border-bottom: 2px solid #0081b9;
        }
        .g_tab>.selected {
            border: 2px solid #0081b9;
            border-bottom: 0;
        }
        .g_tab>*>a {
            font-size: 14px;
        }
        .tb_list th {
            font-size: 14px;
        }
        .tb_list td {
            font-size: 13px;
        }
        .g_blue_table tr th {
            background-color: #e3f0f3;
        }
        .g_blue_table,
        .g_blue_table tr th,
        .g_blue_table tr td {
            border: solid 1px #89c1ce;
        }
    </style>
    <!--▼▼▼ 캐릭터 등롤 알리미 ▼▼▼ -->
    <div class="g_container" id="g_CONTENT">
        @include('aside.myroom',['group'=>'mileage'])
        <div class="g_content">
            <!-- ▼ 타이틀 //-->
            <div class="g_title_blue no-border">내 마일리지</div>
            <!-- ▲ 타이틀 //-->
            <!-- ▼ 메뉴탭 //-->
            <div class="g_tab f-14">
                <div class="{{$type == 'charge' ? 'selected' : ''}}"><a href="{{route('my_mileage_index_c')}}">마일리지 충전</a></div>
                <div class="{{$type == 'exchange' ? 'selected' : ''}}"><a href="{{route('my_mileage_index_e')}}">마일리지 출금</a></div>
                <div class=""><a href="{{route('my_mileage_calendar')}}">마일리지 달력보기</a></div>
                <div class=""><a href="{{route('my_mileage_detail_list')}}">상세내역보기</a></div>
            </div>
            <!-- ▲ 메뉴탭 //-->
            @if ($type == 'charge')
                <iframe src="{{route('mileage_payment_charge')}}" width="100%" height="500" frameBorder="0"></iframe>
            @else
                <iframe src="{{route('mileage_payment_exchange')}}" width="100%" height="500" frameBorder="0"></iframe>
            @endif
            <div class="g_finish"></div>
        </div>
        <div class="g_finish"></div>
    </div>
    <!-- ▲ 컨텐츠 영역 //-->
@endsection
