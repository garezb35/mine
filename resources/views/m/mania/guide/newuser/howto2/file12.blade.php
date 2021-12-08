@extends('layouts-mania.app')

@section('head_attach')
    <link type='text/css' rel='stylesheet' href='/mania/guide/css/common.css'>
    <link type='text/css' rel='stylesheet' href='/mania/guide/frshmn_guide/css/frshmn.css'>
    <link type="text/css" rel="stylesheet" href="/mania/dev/guide_arrow.css">
    <!--<script type="text/javascript" src="/mania/advertise/advertise_code_head.js?v=200727"></script>-->
    <script type="text/javascript" src="/mania/_banner/js/banner_module.js?v=210209"></script>
@endsection

@section('foot_attach')

    <script type='text/javascript' src='/mania/guide/frshmn_guide/js/common.js'></script>
    <script type='text/javascript'>
        var gsVersion = '2111181739';
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
            <div class="g_title_blue no-border"> 초보자 가이드 </div>
            <div class="g_gray_border"></div>
            <!-- ▲ 타이틀 //-->
            <!-- ▼ 메뉴탭 //-->
            <div class="g_tab">
                <div class="selected"><a href="{{route('guide_howto')}}">거래방법 보기</a></div>
                <div class=""><a href="/guide/frshmn_guide/movie.html">동영상 가이드</a></div>
                <div class=""><a href="/guide/frshmn_guide/safe.html">안전 거래 시스템</a></div>
                <div class=""><a href="/guide/frshmn_guide/trade.html">거래시 주의사항</a></div>
                <div class=""><a href="/guide/frshmn_guide/fraud_srh.html">거래 사기 실시간 조회</a></div>
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
                    <a href="{{route('guide_howto')}}" class="blue_arrow_right">
                        <div>구매할 물품<br>검색 후 구매신청</div>
                    </a>
                    <a href="?file=12" class="green_arrow_right2">
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
            <div class="g_subtitle_blue">구매할 물품등록</div>
            <div class="guide_subtitle">
                <span class="f_red1 f_bold">하나. </span> 메인 상단의 "구매등록" 메뉴를 클릭합니다.
            </div>
            <img src="/mania/img/guide/screenshot/img_buyreg_01.png" width="820" alt="">
            <div class="g_finish"></div>
            <div class="guide_subtitle">
                <span class="f_red1 f_bold">둘. </span>구매를 원하는 물품의 정보를 순서대로 입력하신 후 하단의 <b>[구매등록]</b> 버튼을 클릭 합니다.<br>
                삽니다 등록 페이지의 <b>삽니다 등록 알아두기</b>를 먼저 꼼꼼히 읽어보세요.
            </div>
            <img src="/mania/img/guide/screenshot/img_buyreg_02.png" width="820" alt="">
            <div class="g_finish"></div>
            <div class="guide_subtitle">
                <span class="f_red1 f_bold">셋. </span>구매 물품정보를 다시 확인 합니다.
            </div>
            <img src="/mania/img/guide/screenshot/img_buyreg_03.png" width="820"  alt="">
            <br> <span class="guide_subtxt">* 등록한 물품은 </span><span class="f_bold">마이룸 > 판매관련 > 판매등록물품</span>에서 확인가능합니다.
            <div class="g_finish"></div>
            <div class="divi_line"></div>
            <a href="#top">
                <img class="g_right" src="/mania/img/icons/btn_up2.gif" width="61" height="20" alt="맨위로">
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
