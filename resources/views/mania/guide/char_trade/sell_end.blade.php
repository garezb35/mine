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
        .trade_category li {
            float: left;
        }
        .trade_category .next_arrow3 {
            margin: 20px 14px;
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
            <div class="g_title_blue no-border">캐릭터 거래</div>
            <div class="g_gray_border"></div>
            <!-- ▲ 타이틀 //-->
            <!-- ▼ 메뉴탭 //-->
            {{--            <div class="g_tab">--}}
            {{--                <div class="selected"><a href="index.html">캐릭터 거래방법(공통)</a></div>--}}
            {{--                <div class="last"><a href="index.html?file=02">구글 정보변경</a></div>--}}
            {{--                <div class="last"><a href="index.html?file=03">페이스북 정보 변경</a></div>--}}
            {{--                <div class="last"><a href="index.html?file=04">게임사 정보변경</a></div>--}}
            {{--                <div class="last"><a href="index.html?file=05">게스트 정보변경</a></div>--}}
            {{--            </div>--}}
            <div class="guide_subtitle">
                <a href="index.html"><span class="f_blue3 f_bold">판매자 가이드</span></a> | <a href="buy_reg.html">구매자 가이드</a>
            </div>
            <div class="g_finish"></div>
            <!-- ▲ 메뉴탭 //-->
            <div class="g_content_inner">
                <ul class="trade_category">
                    <li>
                        <a href="{{route('safe_char_trade')}}">
                            <img class="first btn" src="/mania/img/guide/screenshot/character/cha_01.gif" width="120" height="67" alt="판매할 물품등록">
                        </a>
                    </li>
                    <li class="next_arrow3"><img src="/mania/img/guide/screenshot/character/ico_guide_next.gif" width="18" height="18" alt=""></li>
                    <li>
                        <a href="{{route('safe_deposit_check')}}">
                            <img class="btn" src="/mania/img/guide/screenshot/character/cha_02.gif" width="120" height="67" alt="판매물품 입금확인">
                        </a>
                    </li>
                    <li class="next_arrow3"><img src="/mania/img/guide/screenshot/character/ico_guide_next.gif" width="18" height="18" alt=""></li>
                    <li>
                        <a href="{{route('safe_buyer_info')}}">
                            <img class="btn" src="/mania/img/guide/screenshot/character/cha_03.gif" width="120" height="67" alt="구매자 정보확인">
                        </a>
                    </li>
                    <li class="next_arrow3"><img src="/mania/img/guide/screenshot/character/ico_guide_next.gif" width="18" height="18" alt=""></li>
                    <li>
                        <a href="{{route('safe_char_transfer')}}">
                            <img class="btn" src="/mania/img/guide/screenshot/character/cha_05.gif" width="120" height="67" alt="물품전달 및 인계확인">
                        </a>
                    </li>
                    <li class="next_arrow3"><img src="/mania/img/guide/screenshot/character/ico_guide_next.gif" width="18" height="18" alt=""></li>
                    <li>
                        <a href="{{route('safe_sell_end')}}">
                            <img class="btn" src="/mania/img/guide/screenshot/character/cha_06_on.gif" width="120" height="67" alt="판매종료 물품확인">
                        </a>
                    </li>
                </ul>
                <div class="g_finish"></div>
                <div class="g_subtitle_blue">판매종료 물품확인</div>
                <div class="guide_subtitle">
                    판매종료된 물품은 마이룸 > 종료내역에서 확인하실 수 있습니다.
                </div>
                <img src="/mania/img/guide/screenshot/img_char_sell6_01.png" width="820" height="" alt="">

                {{--                <img src="http://img3.itemmania.com/new_images/guide/screenshot/img_char_sell1_03.jpg" width="820" height="320" alt="">--}}
                {{--                <div class="guide_subtxt">* 등록한 물품은 마이룸 &gt; 판매관련 &gt; 판매등록물품에서 확인가능합니다.</div>--}}
                <div class="divi_line"></div>
            </div>
        </div>
    </div>
    <!-- ▲ 컨텐츠 영역 //-->
@endsection
