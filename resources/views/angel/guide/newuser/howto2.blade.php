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
            <div class="g_title_blue no-border"> 초보자 가이드 </div>
            <div class="g_gray_border"></div>
            <!-- ▲ 타이틀 //-->
            <!-- ▼ 메뉴탭 //-->
            <div class="g_tab">
                <div class="selected"><a href="{{route('guide_howto')}}">거래방법 보기</a></div>
                <!--<div class=""><a href="{{route('guide_movie')}}">동영상 가이드</a></div>-->
                <div class=""><a href="{{route('guide_safe')}}">안전 거래 시스템</a></div>
                <div class=""><a href="{{route('guide_trade')}}">거래시 주의사항</a></div>
                <div class=""><a href="{{route('guide_failed')}}">거래 사기 실시간 조회</a></div>
            </div>
            <div class="g_finish"></div>
            <!-- ▲ 메뉴탭 //-->
            <div class="top_menu">
                <a href="{{route('guide_howto')}}"><span class="g_black2">판매자 가이드</span></a> |
                <a href="{{route('guide_howto2')}}"><span class="f_green2 f_bold">구매자 가이드</span></a>
            </div>
            <div class="g_finish"></div>
            <ul id="guide_sell">
                <li>
                    <a href="{{route('guide_howto')}}" class="green_arrow_right">
                        <div>구매할 물품<br>검색 후 구매신청</div>
                    </a>
                    <a href="?file=12" class="blue_arrow_right2">
                        <div>구매할<br>물품등록</div>
                    </a>
                </li>
                <li>
                    <a href="?file=13" class="blue_arrow2_right">
                        <div style="line-height: 33px;margin-left: 32px;">결제하기</div>
                    </a>
                    <a href="?file=14" class="blue_arrow2_right2">
                        <div style="line-height: 33px;margin-left: 28px;">구매결정/결제하기</div>
                    </a>
                </li>
                <li>
                    <a href="?file=15" class="blue_arrow2">
                        <div style="padding-right: 0;">판매자<br>정보확인</div>
                    </a>
                </li>
                <li>
                    <a href="?file=16" class="blue_arrow3">
                        <div style="padding-right: 0;">물품받기 및<br>인수확인</div>
                    </a>
                </li>
                <li>
                    <a href="?file=17" class="blue_arrow4">
                        <div style="padding-right: 0; padding-left: 30px;">구매종료<br>물품확인</div>
                    </a>
                </li>
            </ul>
            <div class="g_finish"></div>
            <div class="g_subtitle_blue">팝니다 물품 검색 후 구매신청</div>
            <div class="guide_subtitle">
                <span class="f_red1 f_bold">하나. </span> 상단 검색바에서 게임/서버명을 선택합니다.
            </div>
            <img src="/angel/img/guide/screenshot/img_buysch_01.png" width="820" height="460" alt="">
            <div class="g_finish"></div>
            <div class="guide_subtitle">
                <span class="f_red1 f_bold">둘. </span>검색된 물품 목록에서 물품제목과 금액 등을 확인하신 후 구매 의사가 있는 물품을 클릭합니다.
            </div>
            <img src="/angel/img/guide/screenshot/img_buysch_02.png" width="820" height="422" alt="">
            <div class="g_finish"></div>
            <div class="guide_subtitle">
                <span class="f_red1 f_bold">셋. </span>물품정보와 판매자의 신용도, 상세내용을 다시 한번 꼼꼼히 확인하신 후 [구매신청] 버튼을 클릭합니다.
            </div>
            <img src="/angel/img/guide/screenshot/img_buysch_03.png" width="820" height="673" alt="">
            <br> <span class="guide_subtxt">* 등록한 물품은 </span><span class="f_bold">마이룸 > 판매관련 > 판매등록물품</span>에서 확인가능합니다.
            <div class="g_finish"></div>
            <div class="guide_subtitle">
                <span class="f_red1 f_bold">넷. </span>구매정보확인 페이지에서 개인정보 확인 및 결제정보(결제방식)를 선택하여 [구매신청] 버튼을 클릭합니다.
            </div>
            <img src="/angel/img/guide/screenshot/img_buysch_04.png" width="820" height="1057" alt="">
            <br> <span class="guide_subtxt">* 등록한 물품은 </span><span class="f_bold">마이룸 > 판매관련 > 판매등록물품</span>에서 확인가능합니다.
            <div class="g_finish"></div>
            <div class="divi_line"></div>
            <a href="#top">
                <img class="g_right" src="/angel/img/icons/Scroll-to-top.png" width="61" height="60">
            </a>
            <div class="g_finish"></div>
            <div class="g_btn">
                <a class="btn-arrow-right" href="{{route('guide_howto2')}}?file=13" style="padding: 14px 50px; background: #079c43; color: white; font-size: 16px;">결제하기</a>
            </div>
        </div>
        <div class="g_finish"></div>
    </div>
    <!-- ▲ 컨텐츠 영역 //-->
@endsection
