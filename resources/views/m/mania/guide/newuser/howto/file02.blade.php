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

    <style>

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
                <div class=""><a href="/guide/frshmn_guide/movie.html">동영상 가이드</a></div>
                <div class=""><a href="/guide/frshmn_guide/safe.html">안전 거래 시스템</a></div>
                <div class=""><a href="/guide/frshmn_guide/trade.html">거래시 주의사항</a></div>
                <div class=""><a href="/guide/frshmn_guide/fraud_srh.html">거래 사기 실시간 조회</a></div>
            </div>
            <div class="g_finish"></div>
            <!-- ▲ 메뉴탭 //-->
            <div class="top_menu">
                <a href="{{route('guide_howto')}}"><span class="f_blue3 f_bold">판매자 가이드</span></a> |
                <a href="{{route('guide_howto2')}}"><span class="g_black2">구매자 가이드</span></a>
            </div>
            <div class="g_finish"></div>
            <ul id="guide_sell">
                <li>
                    <a href="{{route('guide_howto')}}" class="blue_arrow_right">
                        <div>판매할<br>물품 등록</div>
                    </a>
                    <a href="?file=02" class="green_arrow_right2">
                        <div>삽니다 물품<br>검색 후 판매신청</div>
                    </a>
                </li>
                <li>
                    <a href="?file=03" class="blue_arrow1">
                        <div style="padding-right: 0;">판매물품<br>입금확인</div>
                    </a>
                </li>
                <li>
                    <a href="?file=04" class="blue_arrow2">
                        <div style="padding-right: 0;">구매자<br>정보확인</div>
                    </a>
                </li>
                <li>
                    <a href="?file=05" class="blue_arrow3">
                        <div style="padding-right: 0;">물품전달 및<br>인계확인</div>
                    </a>
                </li>
                <li>
                    <a href="?file=06" class="blue_arrow4">
                        <div style="padding-right: 0; padding-left: 30px;">판매종료<br>물품확인</div>
                    </a>
                </li>
            </ul>
            <div class="g_finish"></div>
            <div class="g_subtitle_blue">삽니다 물품검색 후 판매신청</div>
            <div class="guide_subtitle">
                <span class="f_red1 f_bold">하나. </span>상단 검색바에서 게임/서버명을 선택합니다.
            </div>
            <img src="/angel/img/guide/screenshot/img_search_01.png" width="820" height="448" alt="">
            <div class="g_finish"></div>
            <div class="guide_subtitle">
                <span class="f_red1 f_bold">둘. </span>검색된 물품 목록에서 물품제목과 금액 등을 확인하신 후 판매 의사가 있으신 물품을 클릭합니다.
            </div>
            <img src="/angel/img/guide/screenshot/img_search_02.png" width="820" height="638" alt="">
            <div class="g_finish"></div>
            <div class="guide_subtitle">
                <span class="f_red1 f_bold">셋. </span>물품정보와 개인정보를 확인 하신 후 [판매신청] 버튼을 클릭합니다.
                <br>개인정보의 판매자 캐릭터명은 반드시 입력하셔야 안전한 거래가 이루어집니다.
            </div>
            <img src="/angel/img/guide/screenshot/img_search_03.png" width="820" height="763" alt="">
            <div class="g_finish"></div>
            <div class="divi_line"></div>
            <a href="#top">
                <img class="g_right" src="/angel/img/icons/Scroll-to-top.png" width="61" height="60">
            </a>
            <div class="g_finish"></div>
            <div class="g_btn">
                <a class="btn-arrow-right" href="{{route('guide_howto')}}?file=03" style="padding: 14px 50px; background: #07819C; color: white; font-size: 16px;">판매물품 입금확인</a>
            </div>
        </div>
        <div class="g_finish"></div>
    </div>
    <!-- ▲ 컨텐츠 영역 //-->
@endsection
