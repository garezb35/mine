@extends('layouts-angel.app')

@section('head_attach')
    <link type='text/css' rel='stylesheet' href='/angel/guide/css/common.css'>
    <link type='text/css' rel='stylesheet' href='/angel/guide/frshmn_guide/css/frshmn.css'>
    <link type="text/css" rel="stylesheet" href="/angel/dev/guide_arrow.css">
@endsection

@section('foot_attach')
    <script type='text/javascript' src='/angel/guide/frshmn_guide/js/common.js'></script>
    <script type='text/javascript'>


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
        @include('angel.guide.aside', ['group'=>'new_guide', 'part'=>''])
        <div class="pagecontainer">
            <a name="top"></a>

            <div class="contextual--title no-border">흥정거래</div>
            <div class="g_gray_border"></div>

            <div class="g_notice_box1">
                흥정판매란 구매자의 흥정이 가능한 판매방식이며, 여러 구매자의 흥정신청 가격 중 <br>
                판매자가 원하는 가격에 흥정수락이 가능한 서비스입니다.
            </div>
            <ul class="trade_category" style="margin-top: 24px;">
                <li><a href="{{route('bar_sell_reg')}}"><img class="first btn" src="/angel/img/guide/screenshot/character/bar01.gif" width="134" height="43" alt="흥정판매 등록"></a></li>
                <li class="next_arrow"><img src="/angel/img/guide/screenshot/character/ico_guide_next.gif" width="18" height="18" alt=""></li>
                <li><a href="{{route('bar_buyer_req')}}"><img class="btn" src="/angel/img/guide/screenshot/character/bar02.gif" width="134" height="43" alt="구매자의 흥정신청"></a></li>
                <li class="next_arrow"><img src="/angel/img/guide/screenshot/character/ico_guide_next.gif" width="18" height="18" alt=""></li>
                <li><a href="{{route('bar_seller_app')}}"><img class="btn" src="/angel/img/guide/screenshot/character/bar03_on.gif" width="134" height="43" alt="판매자의 흥정수락"></a></li>
                <li class="next_arrow"><img src="/angel/img/guide/screenshot/character/ico_guide_next.gif" width="18" height="18" alt=""></li>
                <li><a href="{{route('bar_buyer_pay')}}"><img class="btn" src="/angel/img/guide/screenshot/character/bar04.gif" width="134" height="43" alt="구매자의 결제"></a></li>
                <li class="next_arrow"><img src="/angel/img/guide/screenshot/character/icon_guide_end.gif" width="18" height="18" alt=""></li>
                <li><a href="{{route('bar_re_bargain')}}"><img class="btn" src="/angel/img/guide/screenshot/character/bar05.gif" width="134" height="43" alt="재흥정"></a></li>
            </ul>
            <div class="empty-high"></div>
            <div class="highlight_contextual">판매자의 흥정수락</div>
            <div>흥정신청이 들어오면 판매자에게 SMS 안내 및 거래관련 메시지로 흥정신청을 알려드립니다</div>
            <div class="guide_subtitle">
                <span class="text-rock font-weight-bold">하나. </span>마이룸 > 판매관련 > [흥정신청된 물품]에서 흥정신청내역을 확인하실 수 있습니다.
            </div>
            <img class="" src="/angel/img/guide/screenshot/img_bar_acc01.png" width="820" height="" alt="">
            <div class="guide_subtxt">
                <div class="font-weight-bold">1. 즉시판매 금액</div>
                - 흥정물품이지만 구매자가 즉시판매금액으로 구매신청할 경우 해당 금액으로 판매가 가능합니다.
                <div class="font-weight-bold">2. 최저 흥정가격 설정</div>
                - 최소한의 최저흥정가격을 설정하여 터무니 없는 흥정신청이 들어오지 않게 하는 금액설정 기능입니다.
            </div>
            <div class="guide_subtitle"><span class="text-rock font-weight-bold">둘. </span>판매 물품정보를 다시 확인 합니다.</div>
            <img src="/angel/img/guide/screenshot/img_bar_acc02.png" width="820" height="" alt="">
            <div class="guide_subtxt">* 등록한 물품은 마이룸&gt;판매관련&gt;판매등록물품에서 확인 가능합니다.</div>
        </div>
        <div class="empty-high"></div>
    </div>

@endsection
