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
        .trade_category .next_arrow3 {
            margin: 20px 14px;
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

            <div class="contextual--title no-border">캐릭터 거래</div>
            <div class="g_gray_border"></div>


            {{--            <div class="react_nav_tab">--}}
            {{--                <div class="selected"><a href="index.html">캐릭터 거래방법(공통)</a></div>--}}
            {{--                <div class="last"><a href="index.html?file=02">구글 정보변경</a></div>--}}
            {{--                <div class="last"><a href="index.html?file=03">페이스북 정보 변경</a></div>--}}
            {{--                <div class="last"><a href="index.html?file=04">게임사 정보변경</a></div>--}}
            {{--                <div class="last"><a href="index.html?file=05">게스트 정보변경</a></div>--}}
            {{--            </div>--}}
            <div class="guide_subtitle">
                <a href="index.html"><span class="f_blue3 font-weight-bold">판매자 가이드</span></a> | <a href="buy_reg.html">구매자 가이드</a>
            </div>
            <div class="empty-high"></div>

            <div class="g_content_inner">
                <ul class="trade_category">
                    <li>
                        <a href="{{route('safe_char_trade')}}">
                            <img class="first btn" src="/angel/img/guide/screenshot/character/cha_01.gif" width="120" height="67" alt="판매할 물품등록">
                        </a>
                    </li>
                    <li class="next_arrow3"><img src="/angel/img/guide/screenshot/character/ico_guide_next.gif" width="18" height="18" alt=""></li>
                    <li>
                        <a href="{{route('safe_deposit_check')}}">
                            <img class="btn" src="/angel/img/guide/screenshot/character/cha_02.gif" width="120" height="67" alt="판매물품 입금확인">
                        </a>
                    </li>
                    <li class="next_arrow3"><img src="/angel/img/guide/screenshot/character/ico_guide_next.gif" width="18" height="18" alt=""></li>
                    <li>
                        <a href="{{route('safe_buyer_info')}}">
                            <img class="btn" src="/angel/img/guide/screenshot/character/cha_03.gif" width="120" height="67" alt="구매자 정보확인">
                        </a>
                    </li>
                    <li class="next_arrow3"><img src="/angel/img/guide/screenshot/character/ico_guide_next.gif" width="18" height="18" alt=""></li>
                    <li>
                        <a href="{{route('safe_char_transfer')}}">
                            <img class="btn" src="/angel/img/guide/screenshot/character/cha_05.gif" width="120" height="67" alt="물품전달 및 인계확인">
                        </a>
                    </li>
                    <li class="next_arrow3"><img src="/angel/img/guide/screenshot/character/ico_guide_next.gif" width="18" height="18" alt=""></li>
                    <li>
                        <a href="{{route('safe_sell_end')}}">
                            <img class="btn" src="/angel/img/guide/screenshot/character/cha_06_on.gif" width="120" height="67" alt="판매종료 물품확인">
                        </a>
                    </li>
                </ul>
                <div class="empty-high"></div>
                <div class="highlight_contextual">판매종료 물품확인</div>
                <div class="guide_subtitle">
                    판매종료된 물품은 마이룸 > 종료내역에서 확인하실 수 있습니다.
                </div>
                <img src="/angel/img/guide/screenshot/img_char_sell6_01.png" width="820" height="" alt="">
                <div class="divi_line"></div>
            </div>
        </div>
    </div>

@endsection
