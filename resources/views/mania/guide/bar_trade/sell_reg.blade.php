@extends('layouts-mania.app')

@section('head_attach')
    <link type="text/css" rel="stylesheet" href="/mania/_css/_comm.css?v=210317">
    <link type="text/css" rel="stylesheet" href="/mania/_head_tail/css/_head_comm.css?v=211109">
    <link type="text/css" rel="stylesheet" href="/mania/_banner/css/banner_module.css?v=210422">
    <link type='text/css' rel='stylesheet' href='/mania/guide/css/common.css'>
    <link type='text/css' rel='stylesheet' href='/mania/guide/frshmn_guide/css/frshmn.css'>
    <link type="text/css" rel="stylesheet" href="/mania/dev/guide_arrow.css">
    <script type="text/javascript" src="/mania/advertise/advertise_code_head.js?v=200727"></script>
    <script type="text/javascript" src="/mania/_banner/js/banner_module.js?v=210209"></script>
@endsection

@section('foot_attach')
    <script type="text/javascript" src="/mania/_js/_jquery3.js?v=190220"></script>
    <script type="text/javascript" src="/mania/_js/_comm.js?v=21100516"></script>
    <script type="text/javascript" src="/mania/_js/_gs_control_200924.js?v=21101416"></script>
    <script type="text/javascript" src="/mania/_js/_common_initialize_new.js?v=21110910"></script>
    <script type='text/javascript' src='/mania/guide/frshmn_guide/js/common.js'></script>
    <script type='text/javascript'>
        var gsVersion = '2111181739';
        var _LOGINCHECK = '1';
    </script>
@endsection

@section('content')
    <style>
        .trade_category li {
            float: left;
        }
        .trade_category .next_arrow {
            margin: 12px 11px;
        }
        .trade_category img {
            padding: 0;
        }

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
        <style>
            .aside .img_wrap {
                width: 214px;
                height: 98px;
                box-sizing: border-box;
                text-align: center;
                margin: 10px 0;
                border: 1px solid #E1E1E1;
            }
            .aside .img_wrap > .title {
                width: 182px;
                height: 30px;
                margin: 0 auto 10px;
                font-size: 13px;
                font-weight: bold;
                color: #636363;
                border-bottom: 1px solid #F1F1F1;
                line-height: 30px;
            }
            .aside .img_wrap > .img_mania_call {
                display: inline-block;
                width: 35px;
                height: 35px;
                background-position: -789px -545px;
                margin: 0 10px 0 15px;
            }
            .aside .img_wrap > .content {
                font-size: 12px;
                font-weight: bold;
                color: #767676;
            }
            .aside .callme {
                display: block;
                height: auto;
                padding: 15px 0;
                background-color: #EBF2F8
            }
            .aside .callme > .img_callme {
                display: inline-block;
                width: 43px;
                height: 35px;
                background-position: -826px -545px;
                margin: 0 3px 0 15px;
            }
            .aside .callme > .callme_title {
                margin-top: -2px;
                font-size: 13px;
                font-weight: bold;
                color: #0081DB;
                border: none;
                height: auto;
            }
            .aside .callme > .callme_title > span {
                font-size: 16px;
                font-weight: bold;
                color: #1D1D1D;
            }
            .aside .callme > .callme_title .go_btn {
                display: inline-block;
                width: 57px;
                height: 19px;
                margin-left: 6px;
                font-size: 11px;
                font-weight: bold;
                color: #FFF;
                background-color: #216ED7;
                text-align: center;
                line-height: 19px;
                vertical-align: text-bottom;
            }
            .ft_orange {
                color: #FF4E00;
            }
        </style>
        @include('mania.guide.aside', ['group'=>'new_guide', 'part'=>''])
        <div class="g_content">
            <a name="top"></a>
            <!-- ▼ 타이틀 //-->
            <div class="g_title_blue no-border">흥정거래</div>
            <div class="g_gray_border"></div>
            <!-- ▲ 타이틀 //-->
            <div class="g_notice_box1">
                흥정판매란?<br>
                구매자의 흥정이 가능한 판매방식이며, 여러 구매자의 흥정신청 가격 중 판매자가 원하는 가격에 흥정수락이 가능한 서비스입니다.
            </div>
            <ul class="trade_category" style="margin-top: 24px;">
                <li><a href="{{route('bar_sell_reg')}}"><img class="first btn" src="/mania/img/guide/screenshot/character/bar01_on.gif" width="134" height="43" alt="흥정판매 등록"></a></li>
                <li class="next_arrow"><img src="/mania/img/guide/screenshot/character/ico_guide_next.gif" width="18" height="18" alt=""></li>
                <li><a href="{{route('bar_buyer_req')}}"><img class="btn" src="/mania/img/guide/screenshot/character/bar02.gif" width="134" height="43" alt="구매자의 흥정신청"></a></li>
                <li class="next_arrow"><img src="/mania/img/guide/screenshot/character/ico_guide_next.gif" width="18" height="18" alt=""></li>
                <li><a href="{{route('bar_seller_app')}}"><img class="btn" src="/mania/img/guide/screenshot/character/bar03.gif" width="134" height="43" alt="판매자의 흥정수락"></a></li>
                <li class="next_arrow"><img src="/mania/img/guide/screenshot/character/ico_guide_next.gif" width="18" height="18" alt=""></li>
                <li><a href="{{route('bar_buyer_pay')}}"><img class="btn" src="/mania/img/guide/screenshot/character/bar04.gif" width="134" height="43" alt="구매자의 결제"></a></li>
                <li class="next_arrow"><img src="/mania/img/guide/screenshot/character/icon_guide_end.gif" width="18" height="18" alt=""></li>
                <li><a href="{{route('bar_re_bargain')}}"><img class="btn" src="/mania/img/guide/screenshot/character/bar05.gif" width="134" height="43" alt="재흥정"></a></li>
            </ul>
            <div class="g_finish"></div>
            <div class="g_subtitle_blue">흥정판매 등록</div>
            <div class="guide_subtitle">
                <span class="f_red1 f_bold">하나. </span>팝니다 등록 중 물품종류의 게임머니를 제외한 아이템, 기타 항목 선택 시&nbsp;판매유형에서 흥정을 선택하여 등록합니다.
            </div>
            <img class="" src="/mania/img/guide/screenshot/img_bar_reg01.png" width="820" height="" alt="">
            <div class="guide_subtxt">
                <div class="f_bold">1. 즉시판매 금액</div>
                - 흥정물품이지만 구매자가 즉시판매금액으로 구매신청할 경우 해당 금액으로 판매가 가능합니다.
                <div class="f_bold">2. 최저 흥정가격 설정</div>
                - 최소한의 최저흥정가격을 설정하여 터무니 없는 흥정신청이 들어오지 않게 하는 금액설정 기능입니다.
            </div>
            <div class="guide_subtitle"><span class="f_red1 f_bold">둘. </span>판매 물품정보를 다시 확인 합니다.</div>
            <img src="/mania/img/guide/screenshot/img_bar_reg02.png" width="820" height="" alt="">
            <div class="guide_subtxt">* 등록한 물품은 마이룸&gt;판매관련&gt;판매등록물품에서 확인 가능합니다.</div>
        </div>
        <div class="g_finish"></div>
    </div>
    <!-- ▲ 컨텐츠 영역 //-->
@endsection
