@extends('layouts-angel.app-frame')

@section('head_attach')
    <link type="text/css" rel="stylesheet" href="/angel/myroom/mileage/my_mileage/css/index.css" />
@endsection

@section('foot_attach')

    <script type='text/javascript' src='/angel/myroom/mileage/payment/js/mile_gift.js'></script>
    <script type='text/javascript'>


    </script>
@endsection

@section('content')
    <style>
        .contextual--title {
            margin-left: 20px;
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

    <div @class('bg-white')>
        <div>
            @include("angel.myroom.header")
        </div>
        <div >
            @include('aside.myroom',['group'=>'mileage'])
            <div class="pagecontainer">
                <div class="react_nav_tab navs__pops">
                    <div class="{{$type == 'charge' ? 'selected' : ''}}"><a href="{{route('my_mileage_index_c')}}">마일리지 충전</a></div>
                    <div class="{{$type == 'exchange' ? 'selected' : ''}}"><a href="{{route('my_mileage_index_e')}}">마일리지 출금</a></div>
                    <div class=""><a href="{{route('my_mileage_calendar')}}">달력보기</a></div>
                    <div class=""><a href="{{route('my_mileage_detail_list')}}">상세내역보기</a></div>
                </div>

                <div @class('brl brb global_milwage')>
                    @if ($type == 'charge')
                        <iframe src="{{route('mileage_payment_charge')}}" width="100%"  frameBorder="0" scrolling="0" id="mileage_frame" height="440px"></iframe>
                    @else
                        <iframe src="{{route('mileage_payment_exchange')}}" width="100%"  frameBorder="0" scrolling="0" id="mileage_frame" height="440px"></iframe>
                    @endif
                </div>
                <div class="empty-high"></div>
            </div>
        </div>
        <div class="empty-high"></div>
    </div>

@endsection
