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

            <div class="contextual--title no-border"> 초보자 가이드 </div>
            <div class="g_gray_border"></div>


            <div class="react_nav_tab">
                <div class="selected"><a href="{{route('guide_howto')}}">거래방법 보기</a></div>

                <div class=""><a href="{{route('guide_safe')}}">안전 거래 시스템</a></div>
                <div class=""><a href="{{route('guide_trade')}}">거래시 주의사항</a></div>
                <div class=""><a href="{{route('guide_failed')}}">거래 사기 실시간 조회</a></div>
            </div>
            <div class="empty-high"></div>

            <div class="top_menu">
                <a href="{{route('guide_howto')}}"><span class="g_black2">판매자 가이드</span></a> |
                <a href="{{route('guide_howto2')}}"><span class="f_green2 font-weight-bold">구매자 가이드</span></a>
            </div>
            <div class="empty-high"></div>
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
            <div class="empty-high"></div>
            <div class="highlight_contextual">구매할 물품등록</div>
            <div class="guide_subtitle">
                <span class="text-rock font-weight-bold">하나. </span> 메인 상단의 "구매등록" 메뉴를 클릭합니다.
            </div>
            <img src="/angel/img/guide/screenshot/img_buyreg_01.png" width="820" alt="">
            <div class="empty-high"></div>
            <div class="guide_subtitle">
                <span class="text-rock font-weight-bold">둘. </span>구매를 원하는 물품의 정보를 순서대로 입력하신 후 하단의 <b>[구매등록]</b> 버튼을 클릭 합니다.<br>
                삽니다 등록 페이지의 <b>삽니다 등록 알아두기</b>를 먼저 꼼꼼히 읽어보세요.
            </div>
            <img src="/angel/img/guide/screenshot/img_buyreg_02.png" width="820" alt="">
            <div class="empty-high"></div>
            <div class="guide_subtitle">
                <span class="text-rock font-weight-bold">셋. </span>구매 물품정보를 다시 확인 합니다.
            </div>
            <img src="/angel/img/guide/screenshot/img_buyreg_03.png" width="820"  alt="">
            <br> <span class="guide_subtxt">* 등록한 물품은 </span><span class="font-weight-bold">마이룸 > 판매관련 > 판매등록물품</span>에서 확인가능합니다.
            <div class="empty-high"></div>
            <div class="divi_line"></div>
            <a href="#top">
                <img class="float__right" src="/angel/img/icons/Scroll-to-top.png" width="61" height="60">
            </a>
            <div class="empty-high"></div>
            <div class="btn-groups_angel">
                <a class="btn-arrow-right" href="{{route('guide_howto2')}}?file=13" style="padding: 14px 50px; background: #079c43; color: white; font-size: 16px;">결제하기</a>
            </div>
        </div>
        <div class="empty-high"></div>
    </div>

@endsection
