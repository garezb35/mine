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
        <div class="g_content">
            <a name="top"></a>
            <!-- ▼ 타이틀 //-->
            <div class="g_title_blue no-border">흥정거래</div>
            <div class="g_gray_border"></div>
            <!-- ▲ 타이틀 //-->
            <div class="g_notice_box1">
                흥정판매란 구매자의 흥정이 가능할 수 있도록 물품을 등록하여 판매하는 방식이며, 여러 구매자의 흥정신청 가격 중<br>
                판매자가 원하는 가격에 흥정을 수락하여 거래하는 서비스입니다.
            </div>
            <ul class="trade_category" style="margin-top: 24px;">
                <li><a href="{{route('bar_sell_reg')}}"><img class="first btn" src="/angel/img/guide/screenshot/character/bar01.gif" width="134" height="43" alt="흥정판매 등록"></a></li>
                <li class="next_arrow"><img src="/angel/img/guide/screenshot/character/ico_guide_next.gif" width="18" height="18" alt=""></li>
                <li><a href="{{route('bar_buyer_req')}}"><img class="btn" src="/angel/img/guide/screenshot/character/bar02_on.gif" width="134" height="43" alt="구매자의 흥정신청"></a></li>
                <li class="next_arrow"><img src="/angel/img/guide/screenshot/character/ico_guide_next.gif" width="18" height="18" alt=""></li>
                <li><a href="{{route('bar_seller_app')}}"><img class="btn" src="/angel/img/guide/screenshot/character/bar03.gif" width="134" height="43" alt="판매자의 흥정수락"></a></li>
                <li class="next_arrow"><img src="/angel/img/guide/screenshot/character/ico_guide_next.gif" width="18" height="18" alt=""></li>
                <li><a href="{{route('bar_buyer_pay')}}"><img class="btn" src="/angel/img/guide/screenshot/character/bar04.gif" width="134" height="43" alt="구매자의 결제"></a></li>
                <li class="next_arrow"><img src="/angel/img/guide/screenshot/character/icon_guiade_end.gif" width="18" height="18" alt=""></li>
                <li><a href="{{route('bar_re_bargain')}}"><img class="btn" src="/angel/img/guide/screenshot/character/bar05.gif" width="134" height="43" alt="재흥정"></a></li>
            </ul>
            <div class="g_finish"></div>
            <div class="g_subtitle_blue">구매자의 흥정신청</div>
            <div class="guide_subtitle">
                <span class="f_red1 f_bold">하나. </span>상단의 검색기능을 사용하여 팝니다에 등록된 분할 물품 중 <b>흥정 아이콘이 적용된 물품을 선택</b>합니다.
            </div>
            <img class="" src="/angel/img/guide/screenshot/img_bar_req01.png" width="820" height="" alt="">
            <div class="guide_subtitle">
                <span class="f_red1 f_bold">둘. </span>
                주문물품 정보 및 판매자의 신용정보 등 을 확인 후 <b>[흥정신청]</b> 버튼을 클릭합니다.
            </div>
            <img src="/angel/img/guide/screenshot/img_bar_req02.png" width="820" height="" alt="">
            <div class="guide_subtitle">
                <span class="f_red1 f_bold">셋. </span>
                흥정금액 및 구매자 캐릭명을 입력하신 후 <b>[흥정신청]</b> 버튼을 클릭하시면 흥정신청이 완료 됩니다.
            </div>
            <img src="/angel/img/guide/screenshot/img_bar_req03.png" width="820" height="" alt="">
            <div class="guide_subtxt">* 등록한 물품은 마이룸>판매관련>팝니다에 등록한 물품에서 확인 가능합니다.
                <br>* 흥정신청은 최소흥정가능금액 이상부터 가능하며, 즉시판매 금액보다 높은 금액으로는 흥정신청이 되지 않습니다.
                <br>* 즉시구매는 판매자가 설정한 즉시판매금액으로 가격으로 신청되며, 거래진행 방식은 일반거래와 동일합니다.
            </div>
        </div>
        <div class="g_finish"></div>
    </div>
    <!-- ▲ 컨텐츠 영역 //-->
@endsection