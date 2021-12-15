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
        .trade_category .next_arrow4 {
            margin: 20px 42px;
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
                <a href="{{route('safe_char_trade')}}">판매자 가이드</a> | <a href="{{route('safe_buy_reg')}}"><span class="f_green2 font-weight-bold">구매자 가이드</span></a>
            </div>
            <div class="empty-high"></div>

            <div class="g_content_inner">
                <ul class="trade_category">
                    <li><a href="{{route('safe_buy_reg')}}"><img class="first btn" src="/angel/img/guide/screenshot/character/char_buy01_on.gif" width="120" height="67" alt="구매 신청"></a></li>
                    <li class="next_arrow4"><img src="/angel/img/guide/screenshot/character/ico_guide_next.gif" width="18" height="18" alt=""></li>
                    <li><a href="{{route('safe_seller_info')}}"><img class="btn" src="/angel/img/guide/screenshot/character/char_buy02.gif" width="120" height="67" alt="판매자 정보확인"></a></li>
                    <li class="next_arrow4"><img src="/angel/img/guide/screenshot/character/ico_guide_next.gif" width="18" height="18" alt=""></li>
                    <li><a href="{{route('safe_take_over')}}"><img class="btn" src="/angel/img/guide/screenshot/character/char_buy04.gif" width="120" height="67" alt="물품받기 및 인수확인"></a></li>
                    <li class="next_arrow4"><img src="/angel/img/guide/screenshot/character/ico_guide_next.gif" width="18" height="18" alt=""></li>
                    <li><a href="{{route('safe_buy_end')}}"><img class="btn" src="/angel/img/guide/screenshot/character/char_buy05.gif" width="120" height="67" alt="구매종료 물품확인"></a></li>
                </ul>
                <div class="empty-high"></div>
                <div class="highlight_contextual">판매한 물품등록</div>
                <div class="guide_subtitle">
                    <span class="f_red1 font-weight-bold">하나. </span>상단 검색바에서 게임/서버명을 선택합니다.
                </div>
                <img src="/angel/img/guide/screenshot/img_char_buy1_01.png" width="820" height="" alt="">
                <div class="guide_subtitle">
                    <span class="f_red1 font-weight-bold">둘. </span>검색된 물품 목록에서 물품제목과 금액 등을 확인하신 후 구매 의사가 있는 물품을 클릭합니다.
                </div>
                <img src="/angel/img/guide/screenshot/img_char_buy1_02.png" width="820" height="" alt="">
                <div class="guide_subtitle">
                    <span class="f_red1 font-weight-bold">셋. </span>물품정보와 판매자의 신용도, 상세내용을 다시 한 번 꼼꼼히 확인하신 후 <b>[구매신청]</b>버튼을 클릭합니다.
                </div>
                <img src="/angel/img/guide/screenshot/img_char_buy1_03.png" width="820" height="" alt="">
                <div class="guide_subtitle">
                    <span class="f_red1 font-weight-bold">넷. </span>구매정보확인 페이지에서 개인정보 확인 및 결제정보(결제방식)를 선택하여 <b>[구매신청]</b>버튼을 클릭합니다.
                </div>
                <img src="/angel/img/guide/screenshot/img_char_buy1_04.png" width="820" height="" alt="">
                {{--                <div class="guide_subtxt">* 등록한 물품은 마이룸 &gt; 판매관련 &gt; 판매등록물품에서 확인가능합니다.</div>--}}
                <div class="divi_line"></div>
            </div>
        </div>
    </div>

@endsection
