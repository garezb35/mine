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

            <div class="contextual--title no-border">거래 편의기능</div>
            <div class="g_gray_border"></div>


            <div class="react_nav_tab">
                <div class="selected"><a href="{{route('talk_box')}}">1:1 대화함</a></div>
                <div><a href="{{route('hide_func')}}">숨김기능</a></div>
                <div class="last"><a href="{{route('howto_search')}}">검색방법</a></div>
            </div>
            <div class="empty-high"></div>

            <div class="highlight_contextual">1:1 대화함</div>
            거래중에 전화로 연락이 어려운 경우 1:1 대화함을 통해 상대거래자와 실시간으로 대화를 주고 받으며, 거래를 진행하실 수 있습니다.
            <div class="guide_subtitle">
                <span class="f_red1 font-weight-bold">하나. </span>거래중인 물품 내 거래정보 하단에  <span class="font-weight-bold">[1:1대화함]</span>이 표시됩니다.
            </div>
            <img src="/angel/img/guide/screenshot/img_con_talk01.png" width="820" height="" alt="">
            <div class="guide_subtitle">
                <span class="f_red1 font-weight-bold">둘. </span>1:1 대화함을 통해 상대 거래자에게 전달하실 내용을 적으신 후 <span class="font-weight-bold">[전송] </span>버튼을 클릭합니다.
            </div>
            <img src="/angel/img/guide/screenshot/img_con_talk02.png" width="820" height="" alt="">
            <div class="g_green1_11">* 1:1 대화함에 상대방의 응답이 없을 경우 오프라인 일 경우도 있으니 반드시 유선상 통화를 하시기 바랍니다.</div>
            <div class="divi_line"></div>
            <a href="#top"><img class="float__right" src="/angel/img/icons/Scroll-to-top.png" width="61" height="60"></a>
        </div>
        <div class="empty-high"></div>
    </div>

@endsection
